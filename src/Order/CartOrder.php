<?php
namespace Iget\CieloCheckout\Order;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as GuzzleClient;
use Iget\CieloCheckout\CieloCheckout;
use Iget\CieloCheckout\Models\CieloOrder;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

class CartOrder implements Arrayable
{
    private $orderNumber;
    private $softDescriptor;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var boolean
     */
    private $antifraudEnabled;

    /**
     * @var
     */
    private $merchantId;

    /**
     * CartOrder constructor.
     * @param $merchantId
     */
    public function __construct($merchantId)
    {
        $this->cart = new Cart();
        $this->shipping = new Shipping();
        $this->customer = new Customer();
        $this->merchantId = $merchantId;
    }

    /**
     * Set the orderNumber
     *
     * @param $orderNumber
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setOrderNumber($orderNumber): CartOrder
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @param $softDescriptor
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setSoftDescriptor($softDescriptor): CartOrder
    {
        $this->softDescriptor = $softDescriptor;

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Cart|\Closure $cart
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setCart($cart): CartOrder
    {
        if ($cart instanceof Cart) {
            $this->cart = $cart;
        } else if ($cart instanceof \Closure) {
            $cart($this->cart);
        }

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Shipping|\Closure $shipping
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setShipping($shipping): CartOrder
    {
        if ($shipping instanceof Cart) {
            $this->shipping = $shipping;
        } else if ($shipping instanceof \Closure) {
            $shipping($this->shipping);
        }

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Customer|\Closure $customer
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setCustomer($customer): CartOrder
    {
        if ($customer instanceof Cart) {
            $this->customer = $customer;
        } else if ($customer instanceof \Closure) {
            $customer($this->customer);
        }

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $cartOrder = [
            'OrderNumber' => $this->orderNumber,
            'SoftDescriptor' => $this->softDescriptor,
        ];

        if (isset($this->cart)) {
            $cartOrder['Cart'] = $this->cart->toArray();
        }

        if (isset($this->shipping)) {
            $cartOrder['Shipping'] = $this->shipping->toArray();
        }

        if (isset($this->payment)) {
            $cartOrder['Payment'] = $this->payment->toArray();
        }

        if (isset($this->customer)) {
            $cartOrder['Customer'] = $this->customer->toArray();
        }

        if (isset($this->antifraudEnabled)) {
            $cartOrder['Options'] = ['AntifraudEnabled' => $this->antifraudEnabled];
        }

        return $cartOrder;
    }

    /**
     * @return string
     */
    public function request(Model $payable)
    {
        $guzzleClient =  new GuzzleClient();

        try {
            $headers = [
                'MerchantId' => config('cielo.merchant_id'),
                'Content-type' => 'application/json'
            ];
            $cieloOrder = new CieloOrder();
            $cieloOrder->payable()->associate($payable);
            $cieloOrder->save();

            $this->setOrderNumber($cieloOrder->order_id);

            $body = $this->toArray();
            $cieloOrder->body = $body;
            $cieloOrder->save();
            $body = json_encode($body);

            $response = $guzzleClient->post(CieloCheckout::ORDER_ENDPOINT, compact('headers', 'body'));

            $response = json_decode($response->getBody());

            return $response->settings->checkoutUrl;
        } catch (RequestException $e) {
            \Log::alert(
                'RequestException when trying to get checkoutUrl from Cielo Checkout',
                [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            );

            return abort(500);
        }
    }
}