<?php
/**
 * Created by PhpStorm.
 * User: esoares
 * Date: 10/09/16
 * Time: 16:07
 */

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
}