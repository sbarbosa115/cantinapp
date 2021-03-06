<?php

namespace App\Services;

use App\DataModels\OrderDataModel;
use App\Model\Balance;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Restaurant;
use App\Model\Side;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Facades\BalanceService;
use InvalidArgumentException;

class OrderService
{
    private const DEFAULT_SIDE_QUANTITY_BY_PRODUCT = 1;
    private const DEFAULT_QUANTITY_PRODUCT = 1;

    public function createOrder(OrderDataModel $orderData): Order
    {
        /** @var $user User */
        $user = Auth::user();
        /** @var $restaurant Restaurant */
        // Unit testing require to find the restaurant entity before each process.
        $restaurant = Restaurant::find($user->restaurant->id);

        if (!$restaurant instanceof Restaurant) {
            throw new InvalidArgumentException('Restaurant was not found.');
        }

        if ($restaurant->allow_orders === false) {
            throw new InvalidArgumentException('Orders are not allowed on this moment.');
        }

        if ($user->activeOrders()->get()->count() > 0) {
            throw new InvalidArgumentException('You have orders that actually are pending to deliver.');
        }

        $orderDate = Carbon::now()->setTimeFromTimeString($orderData->pickup_at);
        $order = Order::create([
            'status' => Order::STATUS_CREATED,
            'pickup_at' => $orderDate->format('Y-m-d H:i:s'),
            'payment_method' => Order::PAYMENT_METHOD_CANTINA,
            'user_id' => $user->id,
            'restaurant_id' => $user->restaurant->id,
        ]);

        foreach ($orderData->products as $productData) {
            $product = Product::find($productData->product_id);

            if (!$product instanceof Product) {
                throw new InvalidArgumentException('This product was not found.');
            }

            $orderProduct = OrderProduct::create([
                'product_id' => $product->id,
                'quantity' => self::DEFAULT_QUANTITY_PRODUCT,
                'comment' => $productData->comment,
                'order_id' => $order->id,
            ]);

            // Adding beverages
            foreach ($productData->beverages as $beverageData) {
                $beverage = Product\Beverage::find($beverageData);

                if(!$beverage instanceof Product\Beverage) {
                    throw new InvalidArgumentException('This beverage was not found.');
                }

                Side::create([
                    'order_product_id' => $orderProduct->id,
                    'product_id' => $beverage->id,
                    'quantity' => self::DEFAULT_SIDE_QUANTITY_BY_PRODUCT,
                    'order_id' => $order->id,
                ]);
            }

            // Adding sides
            foreach ($productData->sides as $sideData) {
                $side = Product\Side::find($sideData);

                if(!$side instanceof Product\Side) {
                    throw new InvalidArgumentException('This side was not found.');
                }

                Side::create([
                    'order_product_id' => $orderProduct->id,
                    'product_id' => $side->id,
                    'quantity' => self::DEFAULT_SIDE_QUANTITY_BY_PRODUCT,
                    'order_id' => $order->id,
                ]);
            }
        }

        $this->calculateOrderStatus($order);

        return $order;
    }

    public function calculateOrderStatus(Order $order): void
    {
        $orderProducts = $order->productsOrder()->get();
        foreach ($orderProducts as $orderProduct) {
            BalanceService::syncUserAndBalance($orderProduct->product, $order);
        }

        foreach ($order->balances()->get() as $balances) {
            if($balances->status === Balance::STATUS_SPENT) {
                $order->payment_status = Order::PAYMENT_STATUS_PAID;
            }
            if ($balances->status === Balance::STATUS_DEBT && $order->payment_status !== Order::PAYMENT_STATUS_PENDING) {
                $order->payment_status = Order::PAYMENT_STATUS_PENDING;
            }

        }
        $order->save();
    }

    public function duplicateOrder(
        OrderDataModel $originalOrder,
        \DateTime $pickUpDate
    ): Order {
        $originalOrder->pickup_at = $pickUpDate->format('H:i');
        return $this->createOrder($originalOrder);
    }

}
