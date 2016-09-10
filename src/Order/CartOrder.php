<?php
namespace Iget\CieloCheckout\Order;


use Illuminate\Contracts\Support\Arrayable;

class CartOrder implements Arrayable
{
    private $orderNumber;
    private $softDescriptor;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var boolean
     */
    private $antifraudEnabled;

    /**
     * CartOrder constructor.
     */
    public function __construct()
    {

    }

    /**
     * Set the orderNumber
     *
     * @param $orderNumber
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setOrderNumber($orderNumber): CartOrder
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @param $softDescriptor
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setSoftDescriptor($softDescriptor): CartOrder
    {
        $this->softDescriptor = $softDescriptor;

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Cart $cart
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setCart(Cart $cart): CartOrder
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Shipping $shipping
     * @return \Iget\CieloCheckout\Order\CartOrder
     */
    public function setShipping(Shipping $shipping): CartOrder
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * @param \Iget\CieloCheckout\Order\Customer $customer
     * @return CartOrder
     */
    public function setCustomer(Customer $customer): CartOrder
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $cartOrder = [
            'OrderNumber' => $this->orderNumber,
            'SoftDescriptor' => $this->softDescriptor,
        ];

        if (isset($this->cart)) {
            $cartOrder['Cart'] = $this->cart->toArray();
        }

        if (isset($this->shipping)) {
            $cartOrder['Shipping'] = $this->shipping->toArray();
        }

        if (isset($this->payment)) {
            $cartOrder['Payment'] = $this->payment->toArray();
        }

        if (isset($this->customer)) {
            $cartOrder['Customer'] = $this->customer->toArray();
        }

        if (isset($this->antifraudEnabled)) {
            $cartOrder['Options'] = ['AntifraudEnabled' => $this->antifraudEnabled];
        }

        return $cartOrder;
    }
}