<?php
namespace Tests\Unit;

use Iget\CieloCheckout\CieloCheckout;
use Iget\CieloCheckout\Order\CartOrder;
use Tests\TestCase;

class CieloCheckoutTest extends TestCase
{
    /** @test */
    public function testSingleton()
    {
        $this->assertInstanceOf(CieloCheckout::class, app('cielo'));
    }

    /** @test */
    public function testMakeMethod()
    {
        $this->assertInstanceOf(CartOrder::class, app('cielo')->make());
    }
}
