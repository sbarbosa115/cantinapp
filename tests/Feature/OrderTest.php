<?php

namespace Tests\Feature\Http\Controllers\Frontend;

use App\DataModels\OrderDataModel;
use App\Facades\BalanceService;
use App\Facades\OrderService;
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
        $this->actingAs($this->getUser());

        $orderPayload = $this->createOrderData([], $dishesAmount);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $orderCreated = json_decode($response->getContent(), true);
        return Order::find($orderCreated['order']['id']);
    }

    public function removeBalances(User $user): void
    {
        foreach ($user->allBalances()->get() as $balance) {
            $balance->forceDelete();
        }
    }

    public function testCreateOrderAndRemoveBalance(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $this->removeBalances($user);
        BalanceService::addUserBalance($user, 5);
        $this->assertEquals(5, $user->balances()->count());
        $this->assertEquals(0, $user->balancesSpent()->count());
        $this->assertEquals(0, $user->balancesDebt()->count());

        $order = OrderService::createOrder(
            OrderDataModel::createFromRequest($this->createOrderData([], 2))
        );
        $this->deliverAllOrdersByUser($user);
        $this->assertEquals(3, $user->balances()->count());
        $this->assertEquals(2, $user->balancesSpent()->count());
        $this->assertEquals(0, $user->balancesDebt()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);

        $order = OrderService::createOrder(
            OrderDataModel::createFromRequest($this->createOrderData([], 3))
        );
        $this->deliverAllOrdersByUser($user);
        $this->assertEquals(0, $user->balances()->count());
        $this->assertEquals(5, $user->balancesSpent()->count());
        $this->assertEquals(0, $user->balancesDebt()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);

        $order = OrderService::createOrder(
            OrderDataModel::createFromRequest($this->createOrderData([], 2))
        );
        $this->deliverAllOrdersByUser($user);
        $this->assertEquals(0, $user->balances()->count());
        $this->assertEquals(5, $user->balancesSpent()->count());
        $this->assertEquals(2, $user->balancesDebt()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PENDING, $order->payment_status);

        BalanceService::addUserBalance($user, 5);
        $this->deliverAllOrdersByUser($user);
        $this->assertEquals(3, $user->balances()->count());
        $this->assertEquals(7, $user->balancesSpent()->count());
        $this->assertEquals(0, $user->balancesDebt()->count());
    }

}
