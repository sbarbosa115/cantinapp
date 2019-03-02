<?php

namespace Tests\Feature\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testCreateProduct(): void
    {
        $user = User::where('email', 'juanlopez@example.com')->first();
        $this->actingAs($user);
        $response = $this->call('POST', url('/restaurant/product/create'), [
            'name' => 'TEST NEW PRODUCT',
            'description' => 'TEST NEW PRODUCT DESCRIPTION',
            'price' => 15,
            'tags' => '["some"]',
            'category' => '1',
        ]);

        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $this->followingRedirects();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

}
