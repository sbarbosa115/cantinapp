<?php

namespace Tests;

use App\Model\Employee;
use App\Model\Product;
use App\Model\Restaurant;
use App\Repositories\ProductRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class TestCase extends BaseCase
{
    use RefreshDatabase;

    protected $userCredentials = [
        'email' => 'user@example.com',
        'password' => '123456',
    ];

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/test.php';

        $kernel = $app->make(Kernel::class);
        $kernel->call('migrate');
        $kernel->call('db:seed');
        $kernel->bootstrap();

        Hash::setRounds(4);

        return $app;
    }

    public function createOrderProduct(
        Product $product
    ): array {
        $restaurant = $product->restaurant;

        if (!$restaurant instanceof Restaurant) {
            throw new \LogicException('Restaurant attached to this product was not found.');
        }

        return [
            'product_id' => $product->id,
            'sides' => Product\Side::where('restaurant_id', $restaurant->id)->get()->pluck('id')->toArray(),
            'beverages' => Product\Beverage::where('restaurant_id', $restaurant->id)->get()->pluck('id')->toArray(),
            'comment' => 'TEST-COMMENT-TO-THIS-ORDER',
        ];
    }

    public function createOrderData(
        array $customData = [],
        int $dishesAmount = 1
    ): array {
        $product = Product\Side::all()->first();

        $products = [];
        for($count = 0; $count < $dishesAmount; $count++) {
            $products[] = $this->createOrderProduct($product);
        }

        $orderPayload = [
            'pickup_at' => Carbon::now()->addMinutes(15)->format('H:i'),
            'products' => $products
        ];

        return array_merge($orderPayload, $customData);
    }

    public function loginAsUser(string $email = 'user@example.com'): void
    {
        $user = User::where('email', $email)->first();
        $this->actingAs($user);
    }

    public function loginAsRestaurantEmployee(string $email = 'frank@example.com'): void
    {
        $user = Employee::where('email', $email)->first();
        $this->actingAs($user, 'employee');
    }

    public function getUser(
        string $user = 'user@example.com'
    ): User {
        return User::where('email', $user)->first();
    }

    public function changeProductStatus(Product $product, string $status): void
    {
        $product->status = $status;
        $product->save();
    }
}
