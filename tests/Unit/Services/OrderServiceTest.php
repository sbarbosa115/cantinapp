<?php

namespace Tests\Unit;

use App\Facades\BalanceService;
use App\Facades\OrderService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testDuplicateOrder(): void
    {
        $user = $this->getUser();
        $this->loginAsUser($user->email);
        BalanceService::addUserBalance($user, 5, 'INVOICE-ID-TEST');
        $order = $this->createOrderData([], 1);
        $firstOrder = OrderService::createOrder($order);
        $this->assertEquals($order['pickup_at'], $firstOrder->pickup_at->format('H:i'));

        $orderDate = Carbon::now()->setTimeFromTimeString($order['pickup_at']);
        $secondOrder = OrderService::duplicateOrder($firstOrder, $orderDate);
        $this->assertEquals($order['pickup_at'], $secondOrder->pickup_at->format('H:i'));
    }
}
