<?php
/**
 * Created by PhpStorm.
 * User: esoares
 * Date: 10/09/16
 * Time: 16:07
 */

namespace Iget\CieloCheckout\Order;

use Illuminate\Contracts\Support\Arrayable;

class Cart implements Arrayable
{

    /**
     * Array with Item objects on cart
     *
     * @var array
     */
    private $items = [];

    /**
     * Discount type to be applied (percent or value)
     *
     * @var string
     */
    private $discountType;

    /**
     * Discount value
     *
     * @var float
     */
    private $discountValue;

    /**
     * Add an item to Cart
     *
     * @param \Iget\CieloCheckout\Order\Item $item
     * @return $this
     */
    public function add(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Empty the cart
     *
     * @return $this
     */
    public function empty()
    {
        $this->items = [];

        return $this;
    }

    /**
     * Set a percentual discount on cart.
     * This discount will be applied before the shipping value.
     *
     * @param float $discountValue
     * @return $this
     */
    public function setPercentualDiscount($discountValue)
    {
        $this->discountType = 'percent';
        $this->discountValue = $discountValue;

        return $this;
    }

    /**
     * Set a value of discount on cart.
     * This discount will be applied before the shipping value.
     *
     * @param float $discountValue
     * @return $this
     */
    public function setValueDiscount($discountValue)
    {
        $this->discountType = 'percent';
        $this->discountValue = $discountValue;

        return $this;
    }

    /**
     * Clear discount on cart
     *
     * @return $this
     */
    public function clearDiscount()
    {
        $this->discountType = null;
        $this->discountValue = null;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $cart = [
            'Items' => []
        ];

        if (isset($this->discountType)) {
            $cart['Discount'] = [
                'Type' => $this->discountType,
                'Value' => number_format($this->discountValue, 2, '', '')
            ];
        }

        foreach ($this->items as $item) {
            $cart['Items'][] = $item->toArray();
        }

        return $cart;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getDiscountType(): string
    {
        return $this->discountType;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }
}