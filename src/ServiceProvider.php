<?php namespace Iget\CieloCheckout;

use Iget\CieloCheckout\Models\CieloOrder;
use Iget\CieloCheckout\Models\Observers\CieloOrderObserver;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider  {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/cielo.php';

        $publishPath = config_path('cielo.php');
        $this->publishes([$configPath => $publishPath], 'config');

        CieloOrder::observe(new CieloOrderObserver());
    }

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

        $this->mergeConfigFrom(
            __DIR__.'/../config/cielo.php',
            'cielo'
        );
    }
}