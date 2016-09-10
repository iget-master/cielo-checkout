<?php

namespace Tests;

use Iget\CieloCheckout\CieloCheckoutServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(CieloCheckoutServiceProvider::class);

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }
}