<?php

namespace Tests\Unit;

use App\Classes\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp(): void
    {
        $this->product =  new Product('Yurii', 33);
    }

    function testAProductHasName(){

        $this->assertEquals('Yurii', $this->product->name());
    }


    /** @test */
    function AProductHasACost(){

        $this->assertEquals(33, $this->product->cost());
    }

}
