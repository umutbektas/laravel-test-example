<?php

namespace Tests\Unit;

use App\TestExample\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = new Product('Fallout 4', 28);
    }

    /** @test */
    public function a_product_has_a_name()
    {
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    /** @test */
    public function a_product_has_a_cost()
    {
        $this->assertEquals(28, $this->product->cost());
    }
}
