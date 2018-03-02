<?php

namespace App\Utils;

use App\Model\Balance;
use App\Product;
use App\User;
use App\Order;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;


class Orders
{

    /**
     * Cross balance between request order balance and user available balance.
     * @param Order $order Order to cross.
     * @return array process response status.
     */
    public function crossBalanceAndOrder(Order $order)
    {
        $user = User::findOrFail($order->user_id);
        $result = [];
        if ($user->balance()->count() > $order->getTotalQuantityOrder()) {
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

                    $result = ["status" => "ok", "message" => "The user balance was updated successfully."];
                }
            }

        } else {
            $result = ["status" => "error", "message" => "The user balance is less than the request balance"];
        }

        return $result;
    }

    /**
     * Check if current user has a currently order (Session Order).
     * @param Request $request
     * @return mixed Return order in array format if exist false otherwise.
     * @autho Sergio Barbosa <sbarbosa115@gmail.com>
     */
    public function checkCurrentUser(Request $request)
    {
        $result = collect([]);

        if ($request->session()->has('order')) {
            $result = $request->session()->get('order');
        }

        return $result;
    }


    /**
     * Sync session current user order with cookie.
     * @param Request $request
     * @param Collection $products
     * @author Sergio Barbosa <sbarbosa115@gmail.com>
     */
    public function syncCurrentUserOrder(Request $request, Collection $products)
    {
        $request->session()->put('order', $products);
    }


    /**
     * @param Request $request
     * @param Product $product
     * @param int $quantity
     */
    public function addProductToOrder(Request $request, Product $product, int $quantity)
    {
        $order = $this->checkCurrentUser($request);

        $product->quantity = $quantity;

        $order->push($product);

        $this->syncCurrentUserOrder($request, $order);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function totalOrder(Request $request)
    {
        $total = 0;
        $tax = 0;

        if ($request->session()->has("order")) {
            $collection = $request->session()->get("order");
            foreach ($collection as $product) {
                $total = ($product->price * $product->quantity) + $total;
            }

            if (config('customer.tax')) {
                $tax = $total * config('customer.tax') / 100;
            }
        }

        return ["tax" => $tax, "total" => $total];
    }

}