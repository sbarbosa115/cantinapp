<?php

namespace App\Services;

use App\Model\Balance;
use App\Model\Product;
use App\Model\Side;
use App\Model\Order;
use App\Facades\BalanceService;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function addProductToCurrentOrder(array $userOrder, Product $product): void
    {
        $order = $this->getCurrentSessionOrder();
        foreach ($userOrder['side'] as $key => $side) {
            $sideProduct = clone $product;
            $this->addProductDetails($side, $userOrder, $sideProduct, $key);
            $order->push($sideProduct);
        }
        $this->syncCurrentUserOrder($order);
    }

    public function deleteProductFromCurrentOrder(?Collection $order, Product $product): void
    {
        if($order === null){
            $order = $this->getCurrentSessionOrder();
        }

        $order = $order->reject(function($element) use ($product) {
            return $element->id === $product->id;
        });

        if(!$order){
            $this->syncCurrentUserOrder($order);
        }
    }

    public function getCurrentSessionOrder(): Collection
    {
        $result = collect([]);
        if (session()->has('order')) {
            $result = session()->get('order');
        }
        return $result;
    }

    public function flushCurrentSessionOrder(): void
    {
        session()->forget('order');
    }

    protected function addProductDetails(array $sides, array $userOrder, Product $product, int $index): void
    {
        $product->comment = $userOrder['comment'][$index];
        $product->quantity = $userOrder['quantity'];

        $this->addSidesToProduct($sides, $product);
    }

    protected function syncCurrentUserOrder(Collection $products): void
    {
        session()->put('order', $products);
    }

    public function addSidesToProduct(array $sides, Product $product): void
    {
        $collection = new Collection();
        foreach ($sides as $side){
            $productSide = Product::find($side);
            if($productSide){
                $collection->push($productSide);
            }
        }
        $product->orderProductSides = $collection;
    }

    public function totalOrder(): array
    {
        $total = 0;
        $tax = 0;
        $products = $this->getCurrentSessionOrder();
        if ($products->count() > 0) {

            foreach ($products as $product) {
                $total = ($product->price * 1) + $total;
            }
            if (config('customer.tax')) {
                $tax = $total * config('customer.tax') / 100;
            }
        }
        return ['tax' => $tax, 'total' => number_format($total, 2)];
    }

    public function createOrder(array $details): Order
    {
        $products = $this->getCurrentSessionOrder();
        /** @var $user User */
        $user = Auth::user();
        $order = Order::create([
            'status' => 'created',
            'pickup_at' => $details['pickup_at'],
            'payment_method' => $details['payment_method'],
            'user_id' => $user->id,
        ]);

        $orderStatus = [];
        foreach ($products as $product){
            $comment = $product->comment ?? 'N/A';
            /** @var $order Order */
            $order->products()->attach([$product->id => ['quantity' => 1, 'comment' => $comment]]);
            /** @var $orderProducts Collection */
            $orderProducts = $order->products()->withPivot('id')->get();
            foreach ($product->orderProductSides as $productSide){
                Side::create([
                    'order_product_id' => $orderProducts->last()->pivot->id,
                    'product_id' => $productSide->id,
                    'quantity' => 1,
                    'order_id' => $order->id
                ]);
            }
            $orderStatus[] = BalanceService::removeUserBalance($user, $product, $order);
        }
        $order->payment_status = $this->calculateStatus($orderStatus);
        $order->save();
        $this->flushCurrentSessionOrder();
        return $order;
    }

    protected function calculateStatus(array $orderStatus): String
    {
        $null = 0;
        $balance = 0;
        foreach ($orderStatus as $status){
            if($status === null){
                $null++;
            }
            if($status instanceof Balance){
                $balance++;
            }
        }

        $result = 'incomplete';
        if($null === \count($orderStatus)){
            $result = 'pending';
        } else if($balance === \count($orderStatus)){
            $result =  'paid';
        }
        return $result;
    }

    public function totalOrderProducts(): void
    {
        $this->getCurrentSessionOrder()->count();
    }
}
