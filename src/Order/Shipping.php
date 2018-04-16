<?php

namespace Iget\CieloCheckout\Order;

use Illuminate\Contracts\Support\Arrayable;

class Shipping implements Arrayable
{
    /**
     * @var null
     */
    private $type;
    /**
     * @var null
     */
    private $sourceZipCode;
    /**
     * @var null
     */
    private $targetZipCode;
    /**
     * @var null
     */
    private $address;
    /**
     * @var null
     */
    private $service;
    /**
     * @var null
     */
    private $measures;

    const TYPE_FIXED = 'FixedAmount';
    const TYPE_FREE = 'Free';
    const TYPE_PICKUP = 'WithoutShippingPickUp';
    const TYPE_WITHOUT = 'WithoutShipping';
    const TYPE_CORREIOS = 'Correios';

    /**
     * Shipping constructor.
     * @param null $type
     * @param null $sourceZipCode
     * @param null $targetZipCode
     * @param null $address
     * @param null $service
     * @param null $measures
     */
    public function __construct(
        $type = null,
        $sourceZipCode = null,
        $targetZipCode = null,
        $address = null,
        $service = null,
        $measures = null
    ) {
        $this->type = $type;
        $this->sourceZipCode = $sourceZipCode;
        $this->targetZipCode = $targetZipCode;
        $this->address = $address;
        $this->service = $service;
        $this->measures = $measures;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'Type' => $this->type,
        ];
    }

    /**
     * @param null $type
     * @return Shipping
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}