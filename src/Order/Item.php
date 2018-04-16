<?php

namespace Iget\CieloCheckout\Order;

use Illuminate\Contracts\Support\Arrayable;

class Item implements Arrayable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $sku;

    /**
     * Weight in grams
     *
     * @var int
     */
    private $weight;

    const TYPE_ASSET = 'Asset';
    const TYPE_DIGITAL = 'Digital';
    const TYPE_SERVICE = 'Service';
    const TYPE_PAYMENT = 'Payment';

    /**
     * Item constructor.
     *
     * @param string $name
     * @param float $unitPrice
     * @param int $quantity
     * @param string $type
     * @param string $description
     * @param string $sku
     * @param int $weight
     */
    public function __construct(
        $name = null,
        $unitPrice = null,
        $quantity = null,
        $type = null,
        $description = null,
        $sku = null,
        $weight = null
    ) {
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
        $this->type = $type;
        $this->description = $description;
        $this->sku = $sku;
        $this->weight = $weight;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'Name' => $this->name,
            'Description' => $this->description,
            'UnitPrice' => number_format($this->unitPrice, 2, '', ''),
            'Quantity' => $this->quantity,
            'Type' => $this->type,
            'Sku' => $this->sku,
            'Weight' => $this->weight,
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}