<?php

namespace Tests\Feature\Http\Controllers\Frontend;

use App\Model\Balance;
use App\Model\Order;
use App\Model\Product;
use App\Repositories\ProductRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{

    private function createOrderData(
        array $customData = [],
        int $dishesAmount = 1
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
            $sidesData[$dishesCeil]['comment'] = 'RANDOM COMMENT';
        }

        $orderPayload = [
            'id' => $product->id,
            'pickup_at' => Carbon::now()->addMinutes(15)->format('H:i'),
            'sides' => $sidesData
        ];

        return array_diff($orderPayload, $customData);
    }

    public function testIndexLogged(): void
    {
        $user = User::where('email', 'juanlopez@example.com')->first();
        $this->actingAs($user);
        $response = $this->get(route('frontend.order.index'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testIndexLoggedOut(): void
    {
        $response = $this->get(route('frontend.order.index'));
        $response->assertRedirect(route('frontend.login'));
    }

    public function testCreateOrderFromJson(): void
    {
        $orderPayload = $this->createOrderData();
        $user = User::where('email', 'juanlopez@example.com')->first();
        $this->actingAs($user);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderCreated = json_decode($response->getContent(), true);
        /** @var $order Order */
        $order = Order::find($orderCreated['order']['id']);
        $this->assertEquals(1, $order->productsOrder()->get()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);

        $orderProduct = $order->productsOrder()->get()->first();
        $this->assertEquals('RANDOM COMMENT', $orderProduct->comment);
    }

    public function testCreateOrderFromRunOutBalance(): void
    {
        $user = User::where('email', 'juanlopez@example.com')->first();
        $this->actingAs($user);

        $availableBalance = $user->balances()->get()->count() + 1;
        $orderPayload = $this->createOrderData([], $availableBalance);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderCreated = json_decode($response->getContent(), true);
        $balances = Balance::where('status', Balance::STATUS_DEBT)->where('user_id', $user->id)->get();
        $this->assertEquals(1, $balances->count());

        $order = Order::find($orderCreated['order']['id']);;
        $this->assertEquals(Order::PAYMENT_STATUS_PENDING, $order->payment_status);
    }

}
