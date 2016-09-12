<?php namespace Iget\CieloCheckout;

use Iget\CieloCheckout\Order\CartOrder;

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
}