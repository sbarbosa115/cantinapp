<?php

namespace App\Repository;

use App\Model\Order;
use App\Model\Restaurant;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class OrderRepository
{
    public static function getOrdersICanSee(User $user): Collection
    {
        return Order::where('user_id', $user->id)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public static function getNewestOrdersICanSee(Restaurant $restaurant): Collection
    {
        return Order::whereNotIn('status', [Order::STATUS_DELIVERED])
            ->where('restaurant_id', $restaurant->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy('pickup_at', 'ASC')
            ->get();
    }

    public static function getTotalOrdersTodayByUser(User $user): Collection
    {
        $todayFrom = (new Carbon('today'))->startOfDay();
        $todayEnd = (new Carbon('today'))->endOfDay();
        return Order::where('user_id', $user->id)
            ->whereBetween('created_at', [$todayFrom, $todayEnd])
            ->get();
    }
}
