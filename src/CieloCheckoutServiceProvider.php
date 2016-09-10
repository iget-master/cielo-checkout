<?php namespace Iget\CieloCheckout;

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
    }
}