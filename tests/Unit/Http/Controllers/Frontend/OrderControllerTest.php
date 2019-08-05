<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Model\Balance;
use App\Model\Order;
use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function testIndexLogged(): void
    {
        $this->actingAs($this->getUser());
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
        $this->actingAs($this->getUser());
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderCreated = json_decode($response->getContent(), true);
        /** @var $order Order */
        $order = Order::find($orderCreated['order']['id']);
        $this->assertEquals(1, $order->productsOrder()->get()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);

        $orderProduct = $order->productsOrder()->get()->first();
        $this->assertEquals('TEST-COMMENT-TO-THIS-ORDER', $orderProduct->comment);
    }

    public function testCreateOrderNoComments(): void
    {
        $orderPayload = $this->createOrderData([], 1, true);
        $this->actingAs($this->getUser());
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderCreated = json_decode($response->getContent(), true);
        /** @var $order Order */
        $order = Order::find($orderCreated['order']['id']);

        $this->assertEquals(1, $order->productsOrder()->get()->count());
        $this->assertEquals(Order::PAYMENT_STATUS_PAID, $order->payment_status);
    }

    public function testCreateOrderFromRunOutBalance(): void
    {
        $user = $this->getUser();
        $this->actingAs($this->getUser());

        $orderPayload = $this->createOrderData([], 2);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderPayload = $this->createOrderData([], 2);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderPayload = $this->createOrderData([], 2);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK)->assertJson(['status' => 'ok']);

        $orderCreated = json_decode($response->getContent(), true);
        $balances = Balance::where('status', Balance::STATUS_DEBT)->where('user_id', $user->id)->get();
        $this->assertEquals(1, $balances->count());

        $order = Order::find($orderCreated['order']['id']);;
        $this->assertEquals(Order::PAYMENT_STATUS_PENDING, $order->payment_status);
    }

    public function testFailingOnCreateFirstOrderWithNoBalance(): void
    {
        $this->actingAs($this->getUser('user-2@example.com'));

        $orderPayload = $this->createOrderData([], 1, true);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);

        $response->assertForbidden();
    }

}
