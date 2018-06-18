<?php

namespace Tests\Feature;

use App\Facades\OrderService;
use App\Model\Product;
use Illuminate\Support\Collection;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddProductTest()
    {
        $data = [
            'quantity' => '3',
            'product_id' => '2',
            'side' => [
                0 => '10',
                1 => '12',
                2 => '14',
            ],
            'comment' => null
        ];

        $product = Product::find($data['product_id']);
        if($product){
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();

            $this->assertEquals(1, $order->count());
            foreach ($order as $productOrder) {
                $this->assertEquals(3, $productOrder->orderProductSides->count());
                $this->assertEquals(3, $productOrder->quantity);
                $this->assertEmpty($product->comment);
            }
        }
    }

    public function testMergeTwoSameProductsTest(){
        $data = [
            'quantity' => '3',
            'product_id' => '2',
            'side' => [
                0 => '10',
                1 => '12',
                2 => '14',
            ],
            'comment' => null
        ];

        $product = Product::find($data['product_id']);
        if($product){
            OrderService::addProductToCurrentOrder($data, $product);
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();

            $this->assertEquals(2, $order->count());
            foreach ($order as $productOrder){
                $this->assertEquals(3, $productOrder->orderProductSides->count());
                $this->assertEquals(3, $productOrder->quantity);
                $this->assertEmpty($product->comment);
            }

        }
    }
}
