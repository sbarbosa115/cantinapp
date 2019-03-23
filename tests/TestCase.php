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
        'email' => 'juanlopez@example.com',
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
        int $dishesAmount = 1,
        bool $ignoreComments = false
    ): array {
        $product = Product::find(1);
        $sides = ProductRepository::getSides()->take(4);
        $sidesData = [];

        for ($dishesCeil = 0; $dishesCeil < $dishesAmount; $dishesCeil++) {
            foreach ($sides as $side) {
                $sidesData[$dishesCeil][] = [
                    'id' => $side->id,
                ];
            }
            if(!$ignoreComments) {
                $sidesData[$dishesCeil]['comment'] = 'RANDOM COMMENT';
            }
        }

        $orderPayload = [
            'id' => $product->id,
            'pickup_at' => Carbon::now()->addMinutes(15)->format('H:i'),
            'sides' => $sidesData
        ];

        return array_diff($orderPayload, $customData);
    }

    public function loginAsUser(string $email = 'juanlopez@example.com'): void
    {
        $user = User::where('email', $email)->first();
        $this->actingAs($user);
    }

    public function loginAsRestaurantEmployee(string $email = 'frank@example.com'): void
    {
        $user = Employee::where('email', $email)->first();
        $this->actingAs($user);
    }
}
