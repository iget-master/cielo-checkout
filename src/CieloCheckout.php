<?php namespace Iget\CieloCheckout;

use Iget\CieloCheckout\Order\CartOrder;

class CieloCheckout
{
    private $merchantId;

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
        return new CartOrder();
    }
}