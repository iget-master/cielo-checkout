<?php
namespace Tests\Unit;

use Iget\CieloCheckout\Order\Item;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /** @test */
    public function testItHaveGetters()
    {
        $item = new Item('product', 999.50, 10, 'Asset', 'description', 'sku123', 777);

        $this->assertEquals('product', $item->getName());
        $this->assertEquals(999.50, $item->getUnitPrice());
        $this->assertEquals(10, $item->getQuantity());
        $this->assertEquals('Asset', $item->getType());
        $this->assertEquals('description', $item->getDescription());
        $this->assertEquals('sku123', $item->getSku());
        $this->assertEquals(777, $item->getWeight());
    }

    /** @test */
    public function testItHaveToArrayMethod()
    {
        $item = new Item('product', 999.50, 10, 'Asset', 'description', 'sku123', 'weight');
        $arrayItem = $item->toArray();

        $this->assertArraySubset([
            'Name' => 'product',
            'UnitPrice' => '99950',
            'Quantity' => 10,
            'Type' => 'Asset',
            'Description' => 'description',
            'Sku' => 'sku123',
            'Weight' => 'weight'
        ], $arrayItem);
    }
}
