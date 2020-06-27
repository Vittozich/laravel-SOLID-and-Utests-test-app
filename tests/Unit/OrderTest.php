<?php

namespace Tests\Unit;


use App\Classes\Order;
use App\Classes\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testAnOrderConsistsOfProducts()
    {
        $order = $this->createOrderWithProducts();

        $this->assertCount(2, $order->products());
    }

    /** @test */
    public function an_order_can_determine_the_total_cost_of_all_products()
    {
        $order = $this->createOrderWithProducts();

        $this->assertEquals(55,$order->total());
    }

    protected function createOrderWithProducts(){
        $order = new Order;

        $product = new Product('test1',22);
        $product2 = new Product('test2',33);

        $order->add($product);
        $order->add($product2);

        return $order;
    }

}
