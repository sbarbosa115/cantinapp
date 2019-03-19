<?php

namespace App\Repository;

use App\Model\Order;
use App\User;
use Illuminate\Support\Collection;

class OrderRepository
{
    public static function ordersByCustomer(User $user): Collection
    {
        return Order::where('user_id', $user->id)
            ->orderBy('created_at', 'ASC')
            ->get();
    }
}
