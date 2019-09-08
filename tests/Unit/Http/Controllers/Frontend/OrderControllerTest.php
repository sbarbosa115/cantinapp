<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Model\Balance;
use App\Model\Order;
use App\Model\Product;
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
        $orderPayload = $this->createOrderData([], 1);
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

        $orderPayload = $this->createOrderData([], 1);
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);

        $response->assertForbidden();
    }

    public function testFailingToCreateAnOrderExceedingTheAllowedNumber(): void
    {
        $this->actingAs($this->getUser());
        $exceededNumber = (int) config('cantinapp.LIMIT_DISHES_BY_ORDER');
        $orderPayload = $this->createOrderData([], ++$exceededNumber);

        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testDisableProductAndAddItToAnOrder(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $product = Product::where('restaurant_id', $user->restaurant_id)->first();

        if(!$product instanceof Product) {
            throw new \LogicException('No product was found with this restaurant ID.');
        }
        $this->changeProductStatus($product, Product::STATUS_DISABLED);

        $orderPayload = $this->createOrderData([
            'products' => [$this->createOrderProduct($product)]
        ]);

        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->changeProductStatus($product, Product::STATUS_ENABLED);
    }

    public function testDisableRestaurantOrdersAndGetErrorTryingToAddANewOrder(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $product =  Product::where('restaurant_id', $user->restaurant_id)->first();
        $restaurant = $product->restaurant;

        $restaurant->allow_orders = false;
        $restaurant->save();

        $orderPayload = $this->createOrderData();
        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);

        $restaurant->allow_orders = true;
        $restaurant->save();

        $response = $this->json('POST', route('frontend.order.store'), $orderPayload);
        $response->assertStatus(Response::HTTP_OK);
    }
}
