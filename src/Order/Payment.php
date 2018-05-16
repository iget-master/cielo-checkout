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

    /**
     * @var integer
     */
    private $maxNumberOfInstallments;

    /**
     * @var integer|float
     */
    private $firstInstallmentDiscount;

    /**
     * Payment constructor.
     *
     * @param float|null                                      $boletoDiscount
     * @param float|null                                      $debitDiscount
     * @param \Iget\CieloCheckout\Order\RecurrentPayment|null $recurrentPayment
     * @param int                                             $maxNumberOfInstallments
     * @param float|int                                       $firstInstallmentDiscount
     */
    public function __construct(
        float $boletoDiscount = null,
        float $debitDiscount = null,
        RecurrentPayment $recurrentPayment = null,
        $maxNumberOfInstallments = null,
        $firstInstallmentDiscount = null
    )
    {
        $this->boletoDiscount = $boletoDiscount;
        $this->debitDiscount = $debitDiscount;
        $this->recurrentPayment = $recurrentPayment;
        $this->maxNumberOfInstallments = $maxNumberOfInstallments;
        $this->firstInstallmentDiscount = $firstInstallmentDiscount;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'BoletoDiscount' => $this->boletoDiscount,
            'DebitDiscount' => $this->debitDiscount,
            'RecurrentPayment' => $this->recurrentPayment,
            'MaxNumberOfInstallments' => $this->maxNumberOfInstallments,
            'FirstInstallmentDiscount' => $this->firstInstallmentDiscount,
        ];
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



    /**
     * Set the maxNumberOfInstallments
     *
     * @param $installments
     * @return \Iget\CieloCheckout\Order\Payment
     */
    public function setMaxNumberOfInstallments($installments): Payment
    {
        $this->maxNumberOfInstallments = $installments;

        return $this;
    }

    /**
     * Set the FirstInstallmentDiscount in percent
     *
     * @param $discount
     * @return \Iget\CieloCheckout\Order\Payment
     */
    public function setFirstInstallmentDiscount($discount): Payment
    {
        $this->firstInstallmentDiscount = $discount;

        return $this;
    }
}