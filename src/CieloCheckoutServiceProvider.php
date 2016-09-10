<?php namespace Iget\CieloCheckout;

use Iget\CieloCheckout\Models\CieloOrder;
use Iget\CieloCheckout\Models\Observers\CieloOrderObserver;
use Illuminate\Support\ServiceProvider;

class CieloCheckoutServiceProvider extends ServiceProvider  {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cielo', function ($app) {
            $merchantId = $app['config']['cielo.merchant_id'];

            $trans = new CieloCheckout($merchantId);

            return $trans;
        });

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        CieloOrder::observe(new CieloOrderObserver());
    }
}