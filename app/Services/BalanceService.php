<?php

namespace App\Services;

use App\Model\Balance;
use App\Model\Product;
use App\ModelProduct;
use App\User;
use App\Model\Order;


class BalanceService
{
    public function addUserBalance(User $user, int $quantity): void
    {
        for($i = 0; $i < $quantity; $i++){
            Balance::create([
                'user_id' => $user->id,
                'status' => 'available'
            ]);
        }
    }

    public function removeUserBalance(User $user, Product $product, Order $order): ?Balance
    {
        $balance = Balance::where('user_id', '=', $user->id)
            ->where('status', '=', 'available')
            ->orderBy('id', 'asc')
            ->first();
        if($balance){
            $balance->product_id = $product->id;
            $balance->order_id = $order->id;
            $balance->status = 'spent';
            $balance->save();
        }
        return $balance;
    }

}