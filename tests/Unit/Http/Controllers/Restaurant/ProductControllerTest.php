<?php

namespace Tests\Unit\Http\Controllers\Restaurant;

use App\Model\Product;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    private function getNewTags(): array
    {
        return  ['Tag New 1', 'Tag New 2', 'Tag New 3'];
    }

    private function getEditTags(): array
    {
        return  ['Tag Edit 1', 'Tag Edit 2', 'Tag Edit 3'];
    }

    private function disablingEnablingProduct(Product $product): void
    {
        //Disabling product
        $response = $this->get(route('restaurant.product.change.status', [
            'product' => $product->id,
            'status' => Product::STATUS_DISABLED,
        ]));
        $this->followRedirects($response)->assertOk();

        //Enabling product
        $response = $this->get(route('restaurant.product.change.status', [
            'product' => $product->id,
            'status' => Product::STATUS_ENABLED,
        ]));
        $this->followRedirects($response)->assertOk();
    }

    public function testCreateEditAndRemoveProduct(): void
    {
        $this->loginAsRestaurantEmployee();

        $payload = [
            'name' => 'TEST MEAL PRODUCT 01',
            'description' => 'TEST NEW MEAL DESCRIPTION',
            'price' => 15,
            'tags' => json_encode($this->getNewTags()),
            'type' => Product\Meal::TYPE_MEAL,
        ];

        $response = $this->json('POST', route('restaurant.product.create'), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', $payload['name'])->first();
        $this->assertEquals($payload['name'], $product->name);
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($payload['price'], $product->price);
        $this->assertEquals(3, $product->tags()->count());
        $this->assertEquals($payload['type'], $product->type);

        //Editing Product Test
        $payload = [
            'name' => 'TEST EDIT MEAL 01',
            'description' => 'TEST EDIT MEAL DESCRIPTION',
            'price' => 20,
            'tags' => json_encode($this->getEditTags()),
            'type' => Product\Meal::TYPE_MEAL,
        ];

        $response = $this->json('POST', route('restaurant.product.update', ['product' => $product->id]), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($this->getEditTags(), $product->tags()->pluck('name')->toArray());
        $this->assertCount(count($this->getEditTags()), $product->tags()->pluck('name')->toArray());
        $this->assertEquals($payload['price'], $product->price);

        $this->disablingEnablingProduct($product);

        //Deleting Product
        $response = $this->json('DELETE', route('restaurant.product.delete', ['product' => $product->id]));
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertNull($product);
    }

    public function testCreateEditAndRemoveSide(): void
    {
        $this->loginAsRestaurantEmployee();

        $payload = [
            'name' => 'TEST NEW SIDE 01',
            'description' => 'TEST NEW SIDE DESCRIPTION',
            'price' => 15,
            'tags' => json_encode($this->getNewTags()),
            'type' => Product\Side::TYPE_SIDE,
        ];

        $response = $this->json('POST', route('restaurant.product.create'), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', $payload['name'])->first();
        $this->assertEquals($payload['name'], $product->name);
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($payload['price'], $product->price);
        $this->assertEquals(3, $product->tags()->count());
        $this->assertEquals($payload['type'], $product->type);

        //Editing Product Test
        $payload = [
            'name' => 'TEST EDIT SIDE 01',
            'description' => 'TEST EDIT SIDE DESCRIPTION',
            'price' => 20,
            'tags' => json_encode($this->getEditTags()),
            'type' => Product\Side::TYPE_SIDE,
        ];

        $response = $this->json('POST', route('restaurant.product.update', ['product' => $product->id]), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($this->getEditTags(), $product->tags()->pluck('name')->toArray());
        $this->assertCount(count($this->getEditTags()), $product->tags()->pluck('name')->toArray());
        $this->assertEquals($payload['price'], $product->price);

        //Deleting Product
        $response = $this->json('DELETE', route('restaurant.product.delete', ['product' => $product->id]));
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertNull($product);
    }

    public function testCreateEditAndRemoveBeverage(): void
    {
        $this->loginAsRestaurantEmployee();

        $payload = [
            'name' => 'TEST NEW BEVERAGE 01',
            'description' => 'TEST NEW BEVERAGE DESCRIPTION',
            'price' => 15,
            'tags' => json_encode($this->getNewTags()),
            'type' => Product\Beverage::TYPE_BEVERAGE,
        ];

        $response = $this->json('POST', route('restaurant.product.create'), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', $payload['name'])->first();
        $this->assertEquals($payload['name'], $product->name);
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($payload['price'], $product->price);
        $this->assertEquals(3, $product->tags()->count());
        $this->assertEquals($payload['type'], $product->type);

        //Editing Product Test
        $payload = [
            'name' => 'TEST EDIT BEVERAGE 01',
            'description' => 'TEST EDIT BEVERAGE DESCRIPTION',
            'price' => 20,
            'tags' => json_encode($this->getEditTags()),
            'type' => Product\Beverage::TYPE_BEVERAGE,
        ];

        $response = $this->json('POST', route('restaurant.product.update', ['product' => $product->id]), $payload);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertEquals($payload['description'], $product->description);
        $this->assertEquals($this->getEditTags(), $product->tags()->pluck('name')->toArray());
        $this->assertCount(count($this->getEditTags()), $product->tags()->pluck('name')->toArray());
        $this->assertEquals($payload['price'], $product->price);

        //Deleting Product
        $response = $this->json('DELETE', route('restaurant.product.delete', ['product' => $product->id]));
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $product = Product::where('name', '=', $payload['name'])->first();
        $this->assertNull($product);
    }
}
