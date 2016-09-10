<?php

namespace Iget\CieloCheckout\Order;

use Illuminate\Contracts\Support\Arrayable;

class Payment implements Arrayable
{

    /**
     * @var float
     */
    private $boletoDiscount;

    /**
     * @var float
     */
    private $debitDiscount;

    /**
     * @var RecurrentPayment
     */
    private $recurrentPayment;

    public function __construct(float $boletoDiscount = null, float $debitDiscount = null, RecurrentPayment $recurrentPayment = null)
    {

        $this->boletoDiscount = $boletoDiscount;
        $this->debitDiscount = $debitDiscount;
        $this->recurrentPayment = $recurrentPayment;
    }



    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [];
    }

    /**
     * @param float $boletoDiscount
     * @return Payment
     */
    public function setBoletoDiscount(float $boletoDiscount): Payment
    {
        $this->boletoDiscount = $boletoDiscount;

        return $this;
    }

    /**
     * @param float $debitDiscount
     * @return Payment
     */
    public function setDebitDiscount(float $debitDiscount): Payment
    {
        $this->debitDiscount = $debitDiscount;

        return $this;
    }
}