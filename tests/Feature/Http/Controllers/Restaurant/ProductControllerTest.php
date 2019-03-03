<?php

namespace Tests\Feature\Http\Controllers\Frontend;

use App\Model\Employee;
use App\Model\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testCreateProduct(): void
    {
        $employee = Employee::where('username', 'frank')->first();
        $this->actingAs($employee, 'employee');

        $this->call('POST', url('/restaurant/product/create'), [
            'name' => 'TEST NEW PRODUCT 0056565888',
            'description' => 'TEST NEW PRODUCT DESCRIPTION',
            'price' => 15,
            'tags' => '["some"]',
            'category' => '1',
        ])->assertRedirect(url('/restaurant/product'));

        $products = Product::where('name', 'TEST NEW PRODUCT 0056565888')->get();
        $this->assertCount(1, $products);
    }


}
