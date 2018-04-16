# Cielo Checkout

This package provides simple integration with *Cielo Checkout* on Laravel 5.x.

To use it, you must have a *Cielo Merchant ID*. If you don't have one, please see the [Cielo Checkout docs](https://developercielo.github.io/manual/checkout-cielo). Cielo may require
homologation before enabling your production account.

## Installation

To get started, install Cielo Checkout via the Composer package manager:

    composer require iget-master/cielo-checkout

If you are using Laravel version older then `5.5`, you must include our *Service Provider* to your `config/app.php` file under `providers` section:

    Iget\CieloCheckout\ServiceProvider::class,

The Cielo Checkout service provider registers its own database migrations directory with the framework, so you should migrate your database after registering the provider.
The Cielo Checkout migrations will create the tables needed to store Cielo orders.

    php artisan migrate

Next, you should call the `Cielo::routes()` method withing the boot method of your `RouteServiceProvider` at the end of the `map()` method.
This method will register the necessary routes to allow receiving transaction and status change notifications from Cielo.

This method accepts an optional $options parameter to setup the routes how you want.
You can also call it inside a `Route::group()` callback if necessary.

    <?php
    /** ... */
    use Cielo;
    class RouteServiceProvider extends ServiceProvider
    {
        /** ... */
        public function map()
        {
            $this->mapApiRoutes();
            $this->mapWebRoutes();
            Cielo::routes();
        }
        /** ... */
    }

Under Cielo Checkout control panel (`Vendas Online` -> `Cielo Checkout` -> `Configurações` -> `Pagamentos`) , you should configure
the *notification type* (`Tipo de Notificação`) to `POST`, the *notification url* (`URL de Notificação`) and *status change url*  (`URL de Mudança de Status`) to respectively:

    https://yourdomain.com/cielo/notify
    https://yourdomain.com/cielo/status

This allows Cielo to notify your application when a CieloOrder was paid, or when it status changed.

## Usage

The first step is to create a `CieloOrder`:

    use Iget\CieloCheckout\Order\Cart;
    use Iget\CieloCheckout\Order\Customer;
    use Iget\CieloCheckout\Order\Item;
    use Iget\CieloCheckout\Order\Shipping;

    public function someControllerMethod()
    {
        $order = Cielo::make()
            ->setSoftDescriptor('Descriptor') // Max 13 alphanumeric characters without whitespaces. Underline is allowed.
            ->setCart(function(Cart $cart) {
                $cart->add(new Item('My item label', 345.00, 1, Item::TYPE_ASSET);
            })
            ->setShipping(function(Shipping $shipping) {
                $shipping->setType(Shipping::TYPE_WITHOUT);
            })
            ->setCustomer(function(Customer $customer) { // Optional
                $customer->setIdentity('12345678900') // CPF or CNPJ
                    ->setFullname('Fulano de tal')
                    ->setEmail('fulano@tal.com')
                    ->setPhone('123456789');
            });

        $payableModel = YourOrderModel::find(3232);

        // This will create a new CieloOrder model, and associate it to your $payableModel.
        // If successful, this will generate an URL to where you should redirect your user.
        $redirectUrl = $order->request($payableModel);

        return response()->redirectTo($redirectUrl);
    }

When your client pay the order, your application will be notified. You can watch the `Iget\CieloCheckout\Events\PaymentStatusHasChanged`
event to make your logic after receiving the payment.

The event will give you access to the public properties: `$cieloOrder`, `$oldStatus` and `$newStatus`.

## Disclaimer

This package is free and open source. The package author don't have any relation with Cielo (trademark) and isn't responsible for any consequences caused by it usage.