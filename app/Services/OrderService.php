<?php

namespace App\Services;

use App\Model\Balance;
use App\Model\Product;
use App\Model\Side;
use App\ModelProduct;
use App\User;
use App\Model\Order;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderService
{

    public function addProductToCurrentOrder(array $userOrder, Product $product): void
    {
        $order = $this->getCurrentSessionOrder();

        foreach ($userOrder['side'] as $sides) {
            $sideProduct = clone $product;
            $this->addProductDetails($sides, $userOrder, $sideProduct);
            $order->push($sideProduct);
        }

        $this->syncCurrentUserOrder($order);
    }

    public function deleteProductFromCurrentOrder(Collection &$order = null, Product $product): void
    {
        if(!$order){
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

    protected function addProductDetails(array $sides, array $userOrder, Product &$product): void
    {
        $product->comment = $userOrder['comment'];
        $product->quantity = $userOrder['quantity'];

        $this->addSidesToProduct($sides, $product);
    }

    protected function syncCurrentUserOrder(Collection $products): void
    {
        session()->put('order', $products);
    }


    public function addSidesToProduct(array $sides, Product &$product): void
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



    public function totalOrder()
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
        return ["tax" => $tax, "total" => number_format($total, 2)];
    }

    public function createOrder(array $details): void
    {
        $products = $this->getCurrentSessionOrder();
        $order = Order::create([
            "status" => "created",
            "pickup_at" => $details["pickup_at"],
            "payment_method" => $details["payment_method"],
            "user_id" => Auth::user()->id,
        ]);
        foreach ($products as $product){
            $comment = isset($product->comment) ? $product->comment : "N/A";
            $order->products()->sync([$product->id => ["quantity" => 1, "comment" => $comment]]);

            $orderProduct = $order->products()->where('product_id', $product->id)->withPivot('product_id', 'order_id', 'quantity', 'comment')->first();

            foreach ($product->orderProductSides as $productSide){
                Side::create([
                    'order_product_id' => $orderProduct->pivot->order_id,
                    'product_id' => $productSide->id,
                    'quantity' => 1,
                    'order_id' => $order->id
                ]);
            }
        }

        $this->flushCurrentSessionOrder();
    }

    public function totalOrderProducts(Collection $order): int
    {
        $quantity = 0;
        foreach ($order as $item){
            $quantity = $item->quantity  + $quantity;
        }
        return $quantity;
    }

    public function crossBalanceAndOrder(Order $order): array
    {
        $user = User::find($order->user_id);
        $result = [];
        if ($user->balances()->count() > $order->getTotalQuantityOrder()) {
            $products = $order->products()->get();
            foreach ($products as $product) {
                for ($i = 0; $i < $product->pivot->quantity; $i++) {
                    $balance = Balance::where("user_id", "=", $user->id)
                        ->where("status", "=", "available")
                        ->orderBy('id', 'asc')
                        ->first();

                    $balance->product_id = $product->id;
                    $balance->order_id = $order->id;
                    $balance->status = "spent";
                    $balance->save();

                    $result = true;
                }
            }
        } else {
            $result = "The user balance is less than the request balance";
        }
        return $result;
    }

}