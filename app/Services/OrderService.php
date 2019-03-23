<?php

namespace App\Services;

use App\Model\Balance;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Side;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Facades\BalanceService;

class OrderService
{
    private const DEFAULT_SIDE_QUANTITY_BY_PRODUCT = 1;

    public function createOrder(array $orderData): Order
    {
        /** @var $user User */
        $user = Auth::user();
        $orderDate = Carbon::now()->setTimeFromTimeString($orderData['pickup_at']);
        $order = Order::create([
            'status' => Order::STATUS_CREATED,
            'pickup_at' => $orderDate->format('Y-m-d H:i:s'),
            'payment_method' => Order::PAYMENT_METHOD_CANTINA,
            'user_id' => $user->id,
        ]);

        $product = Product::find($orderData['id']);

        if (!$product instanceof Product) {
            throw new \InvalidArgumentException('This product was not found.');
        }

        foreach ($orderData['sides'] as $dish) {
            $comment = '';
            if(array_key_exists('comment', $dish)) {
                $comment = $dish['comment'];
                unset($dish['comment']);
            }

            $orderProduct = OrderProduct::create([
                'product_id' => $product->id,
                'quantity' => self::DEFAULT_SIDE_QUANTITY_BY_PRODUCT,
                'comment' => $comment,
                'order_id' => $order->id,
            ]);

            foreach ($dish as $key => $side) {
                if (!array_key_exists('id', $side)) {
                    throw new \InvalidArgumentException('The id key was not found.');
                }

                $sideProduct = Product::find($side['id']);
                if (!$sideProduct instanceof Product) {
                    throw new \InvalidArgumentException('This side-product was not found.');
                }

                Side::create([
                    'order_product_id' => $orderProduct->id,
                    'product_id' => $sideProduct->id,
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

}
