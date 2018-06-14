<?php

namespace App\Utils;

use App\Model\Balance;
use App\ModelProduct;
use App\User;
use App\Model\Order;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Orders
{

    /**
     * Cross balance between request order balance and user available balance.
     * @param Order $order Order to cross.
     * @return array process response status.
     */
    public function crossBalanceAndOrder(Order $order)
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
     * Add given product to current order.
     * @param Request $request Request object.
     * @param Product $product Product to add.
     * @param int $quantity Quantity.
     * Sergio Barbosa <sbarbosa115@gmail.com>
     */
    public function addProductToOrder(Request $request, Product $product, int $quantity)
    {
        $order = $this->checkCurrentUser($request);

        $currentQuantity = $this->currentQuantities($order, $product);

        $product->quantity = $quantity + $currentQuantity;
        $product->comment = $request->get("comment");

        $order = $order->reject(function($element) use ($product) {
            return $element->id === $product->id;
        });

        $order->push($product);

        $this->syncCurrentUserOrder($request, $order);
    }

    /**
     * Check if there are quantities with the current product.
     * @param Collection $order User order.
     * @param Product $product Product to check if there are quantities.
     * @return mixed 0 If current quantities are equal to 0 otherwise integer with current quantities.
     */
    public function currentQuantities(Collection $order, Product $product)
    {
        $currentProducts = $order->where("id", $product->id);

        $quantity = 0;

        foreach ($currentProducts as $currentProduct){
            $quantity = $quantity + $currentProduct->quantity;
        }

        return $quantity;
    }


    /**
     * Return the total order, it includes the taxes if there are.
     * @param Request $request Request object.
     * @return array Array with the total and taxes if there is.
     * @author Sergio Barbosa <sbarbosa115@gmail.com>
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

    public function createOrder(Collection $products, array $details): void
    {
        $order = Order::create([
            "status" => "created",
            "pickup_at" => $details["pickup_at"],
            "payment_method" => $details["payment_method"],
            "user_id" => Auth::user()->id,
        ]);

        foreach ($products as $product){
            $comment = isset($product->comment) ? $product->comment : "N/A";
            $order->products()->attach([$product->id], ["quantity" => $product->quantity, "comment" => $comment]);
        }
    }

    /**
     * Return the total order quantity products.
     * @param Collection $order Collection with all products.
     * @return int Number of products in given order.
     */
    public function totalOrderProducts(Collection $order){
        $quantity = 0;
        foreach ($order as $item){
            $quantity = $item->quantity  + $quantity;
        }

        return $quantity;
    }

}