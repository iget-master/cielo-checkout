<?php
namespace Tests\Unit;

use Iget\CieloCheckout\Order\Item;
use Tests\TestCase;

class ItemTest extends TestCase
{
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
