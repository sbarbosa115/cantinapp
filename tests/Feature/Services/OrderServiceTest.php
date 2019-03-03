<?php

namespace Tests\Feature;

use App\Facades\BalanceService;
use App\Facades\OrderService;
use App\Model\Product;
use App\Model\Restaurant;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $restaurant = Restaurant::find(1);
        $this->session([
            'restaurant_id' => $restaurant->id,
            'restaurant' => $restaurant,
        ]);
    }

    public function testAddProductTest(): void
    {
        $data = [
            'quantity' => '1',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'],
            ],
            'comment' => null,
        ];
        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(1, $order->count());
        }
    }

    public function testAddTwoProductsTest(): void
    {
        $data = [
            'quantity' => '1',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'], ['10', '12', '14'],
            ],
            'comment' => null,
        ];
        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(2, $order->count());
        }
    }

    public function testCreateOrderTest(): void
    {
        $data = [
            'quantity' => '2',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'], ['10', '12', '14'],
            ],
            'comment' => null,
        ];

        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(2, $order->count());
            $now = Carbon::now()->addMinutes(15);
            $details = [
                'payment_method' => 'cantina',
                'pickup_at' => $now->format('Y-m-d H:i:s'),
            ];

            //this user is get from users table after run the seeders.
            $user = User::where('email', '=', 'juanlopez@example.com')->first();
            $this->assertNotNull($user);
            if ($user) {
                $this->be($user);
                BalanceService::addUserBalance($user, 2);
                $order = OrderService::createOrder($details);
                $this->assertSame(2, $order->products()->count());
                $this->assertSame('paid', $order->payment_status);
            }
        }
    }

    public function testCreateOrderPendingBalanceTest(): void
    {
        $data = [
            'quantity' => '2',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'], ['10', '12', '14'],
            ],
            'comment' => null,
        ];

        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(2, $order->count());
            $now = Carbon::now()->addMinutes(15);
            $details = [
                'payment_method' => 'cantina',
                'pickup_at' => $now->format('Y-m-d H:i:s'),
            ];

            //this user is get from users table after run the seeders.
            $user = User::where('email', '=', 'juanlopez@example.com')->first();
            $this->assertNotNull($user);
            if ($user) {
                $this->be($user);
                $order = OrderService::createOrder($details);
                $this->assertSame(2, $order->products()->count());
                $this->assertSame('pending', $order->payment_status);
            }
        }
    }

    public function testCreateOrderIncompleteBalanceTest(): void
    {
        $data = [
            'quantity' => '2',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'], ['10', '12', '14'], ['10', '12', '14'],
            ],
            'comment' => null,
        ];

        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(3, $order->count());
            $now = Carbon::now()->addMinutes(15);
            $details = [
                'payment_method' => 'cantina',
                'pickup_at' => $now->format('Y-m-d H:i:s'),
            ];

            //this user is get from users table after run the seeders.
            $user = User::where('email', '=', 'juanlopez@example.com')->first();
            $this->assertNotNull($user);
            if ($user) {
                $this->be($user);
                BalanceService::addUserBalance($user, 2);
                $order = OrderService::createOrder($details);
                $this->assertSame(3, $order->products()->count());
                $this->assertSame('incomplete', $order->payment_status);
            }
        }
    }

    public function testCreateOrderIncompleteOneDishBalanceTest(): void
    {
        $data = [
            'quantity' => '2',
            'product_id' => '2',
            'side' => [
                ['10', '12', '14'], ['10', '12', '14'],
            ],
            'comment' => null,
        ];

        $product = Product::find($data['product_id']);
        if ($product) {
            OrderService::addProductToCurrentOrder($data, $product);
            /** @var $order Collection */
            $order = OrderService::getCurrentSessionOrder();
            $this->assertSame(2, $order->count());
            $now = Carbon::now()->addMinutes(15);
            $details = [
                'payment_method' => 'cantina',
                'pickup_at' => $now->format('Y-m-d H:i:s'),
            ];

            //this user is get from users table after run the seeders.
            $user = User::where('email', '=', 'juanlopez@example.com')->first();
            $this->assertNotNull($user);
            if ($user) {
                $this->be($user);
                BalanceService::addUserBalance($user, 1);
                $order = OrderService::createOrder($details);
                $this->assertSame(2, $order->products()->count());
                $this->assertSame('incomplete', $order->payment_status);
            }
        }
    }
}
