<?php

namespace Tests\Feature\Http\Controllers\Frontend;

use App\Facades\BalanceService;
use App\Model\Balance;
use App\Model\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private function createOrder(int $dishesAmount = 5): Order
    {
        $user = User::where('email', 'juanlopez@example.com')->first();
        $this->actingAs($user);

        $orderPayload = $this->createOrderData([], $dishesAmount);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $orderCreated = json_decode($response->getContent(), true);
        return Order::find($orderCreated['order']['id']);
    }

    public function testCreateOrderAndRemoveBalance(): void
    {
        $user = User::where('email', 'juanlopez@example.com')->first();
        $originalBalances = $user->balances()->get();
        $originalBalancesCount = 0;

        foreach ($originalBalances as $balance) {
            $balance->status = Balance::STATUS_SPENT;
            $balance->save();
            $originalBalancesCount++;
        }

        $balancesAvailable = $user->balances()->get()->count();
        $this->assertEquals(0, $balancesAvailable);

        $order = $this->createOrder();
        $balancesDebt = $user->balancesDebt()->get()->count();
        $this->assertEquals(5, $balancesDebt);

        BalanceService::addUserBalance($user, 5);
        $balancesSpent = $user->balancesSpent()->get()->count();
        $this->assertEquals($originalBalancesCount + 5, $balancesSpent);
        $balancesAvailable = $user->balances()->get()->count();
        $this->assertEquals(0, $balancesAvailable);
        $balancesDebt = $user->balancesDebt()->get()->count();
        $this->assertEquals(0, $balancesDebt);

        // We need to refresh the Order to get it updated.
        $order = Order::find($order->id);
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);
    }

}
