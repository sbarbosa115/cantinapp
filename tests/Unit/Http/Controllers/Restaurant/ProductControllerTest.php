<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Model\Employee;
use App\Model\Product;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testCreateEditAndRemoveProduct(): void
    {
        $employee = Employee::where('username', 'frank')->first();
        $this->actingAs($employee, 'employee');

        $payload = [
            'name' => 'TEST NEW PRODUCT 0056565888',
            'description' => 'TEST NEW PRODUCT DESCRIPTION',
            'price' => 15,
            'tags' => '["TagExample1", "TagExample2", "TagExample3"]',
            'type' => Product\Side::TYPE_SIDE,
        ];

        $response = $this->json('POST', route('restaurant.product.create'), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', 'TEST NEW PRODUCT 0056565888')->first();
        $this->assertEquals('TEST NEW PRODUCT 0056565888', $product->name);
        $this->assertEquals('TEST NEW PRODUCT DESCRIPTION', $product->description);
        $this->assertEquals(15, $product->price);
        $this->assertEquals(3, $product->tags()->count());
        $this->assertEquals(Product\Side::TYPE_SIDE, $product->type);

        //Editing Product Test
        $payload = [
            'name' => 'TEST NEW PRODUCT 0056565888',
            'description' => 'NEW DESCRIPTION',
            'price' => 10,
            'tags' => '["EDITED TAG 1", "EDITED TAG 2", "EDITED TAG 3"]',
            'type' => Product\Side::TYPE_SIDE,
        ];

        $response = $this->json('POST', route('restaurant.product.update', ['product' => $product->id]), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', 'TEST NEW PRODUCT 0056565888')->first();
        $this->assertEquals('NEW DESCRIPTION', $product->description);
        $this->assertEquals(['EDITED TAG 1', 'EDITED TAG 2', 'EDITED TAG 3'], $product->tags()->pluck('name')->toArray());
        $this->assertEquals(10, $product->price);

        //Deleting Product
        $response = $this->json('DELETE', route('restaurant.product.delete', ['product' => $product->id]));
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $product = Product::where('name', 'TEST NEW PRODUCT 0056565888')->first();
        $this->assertNull($product);
    }


}
