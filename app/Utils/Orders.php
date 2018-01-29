<?php

namespace App\Utils;

use App\Model\Balance;
use App\User;
use App\Order;


class Orders{

    /**
     * Cross balance between request order balance and user available balance.
     * @param Order $order Order to cross.
     * @return array process response status.
     */
    public function crossBalanceAndOrder(Order $order){
        $user = User::findOrFail($order->user_id);
        $result = [];
        if($user->balance()->count() > $order->getTotalQuantityOrder()){
            $products = $order->products()->get();

            foreach ($products as $product){
                for($i = 0; $i < $product->pivot->quantity; $i++){

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

}