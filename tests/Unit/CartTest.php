<?php
namespace Tests\Unit;

use Iget\CieloCheckout\Order\Cart;
use Iget\CieloCheckout\Order\Item;
use Tests\TestCase;

class CartTest extends TestCase
{
    /** @test */
    public function testItHaveGetters()
    {
        $cart = new Cart();
        $cart->add(new Item('product1', 999.50, 10, 'Asset', 'description', 'sku123', 'weight'));
        $cart->add(new Item('product2', 999.50, 10, 'Asset', 'description', 'sku123', 'weight'));
        $cart->setPercentualDiscount(99.55);

        $this->assertEquals('percent', $cart->getDiscountType());
        $this->assertEquals('99.55', $cart->getDiscountValue());
        $this->assertInternalType('array', $cart->getItems());
        $this->assertContainsOnlyInstancesOf(Item::class, $cart->getItems());
    }

    /** @test */
    public function testItHaveToArrayMethod()
    {
        $cart = new Cart();
        $cart->add(new Item('product1', 999.50, 10, 'Asset', 'description', 'sku123', 'weight'));
        $cart->add(new Item('product2', 999.50, 10, 'Asset', 'description', 'sku123', 'weight'));
        $cart->setPercentualDiscount(99.55);

        $arrayCart = $cart->toArray();
        $this->assertArraySubset([
            'Discount' => [
                'Type' => 'percent',
                'Value' => '9955'
            ]
        ], $arrayCart);
        $this->assertArrayHasKey('Items', $arrayCart);
        $this->assertInternalType('array', $arrayCart['Items']);
        $this->assertCount(2, $arrayCart['Items']);
    }
}
