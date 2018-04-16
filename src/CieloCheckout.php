<?php namespace Iget\CieloCheckout;

use Iget\CieloCheckout\Order\CartOrder;
use Illuminate\Support\Facades\Route;

class CieloCheckout
{
    private $merchantId;

    /**
     * Cielo Constants
     */

    const ORDER_ENDPOINT = 'https://cieloecommerce.cielo.com.br/api/public/v1/orders';

    /**
     * CieloCheckout constructor.
     *
     * @param $merchantId
     */
    public function __construct($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * Make a new Cielo Order
     */
    public function make()
    {
        return new CartOrder($this->merchantId);
    }

    /**
     * @param array $options
     */
    public function routes(array $options = [])
    {
        $defaultOptions = [
            'namespace' => '\Iget\CieloCheckout\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function() {
            Route::post('/cielo/notify', ['as' => 'cielo.notify', 'uses' => 'CieloController@notify']);
            Route::post('/cielo/status', ['as' => 'cielo.status', 'uses' => 'CieloController@status']);
        });
    }
}