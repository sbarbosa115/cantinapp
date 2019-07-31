<?php

namespace Tests;

use App\Model\Employee;
use App\Model\Product;
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


    public function createOrderData(
        array $customData = [],
        int $dishesAmount = 1
    ): array {
        $product = Product::find(1);

        $products = [];
        for($count = 0; $count < $dishesAmount; $count++) {
            $products[] = [
                'product_id' => $product->id,
                'sides' => Product\Side::all()->pluck('id')->toArray(),
                'beverages' => Product\Beverage::all()->pluck('id')->toArray(),
                'comment' => 'TEST-COMMENT-TO-THIS-ORDER',
            ];
        }

        $orderPayload = [
            'pickup_at' => Carbon::now()->addMinutes(15)->format('H:i'),
            'products' => $products
        ];

        return array_diff($orderPayload, $customData);
    }

    public function loginAsUser(string $email = 'user@example.com'): void
    {
        $user = User::where('email', $email)->first();
        $this->actingAs($user);
    }

    public function loginAsRestaurantEmployee(string $email = 'frank@example.com'): void
    {
        $user = Employee::where('email', $email)->first();
        $this->actingAs($user);
    }

    public function getUser(
        string $user = 'user@example.com'
    ): User {
        return User::where('email', $user)->first();
    }
}
