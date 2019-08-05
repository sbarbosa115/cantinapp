<?php

namespace App\Rules;

use App\Repository\OrderRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DailyLimitOrder implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $user = Auth::user();
        $orders = OrderRepository::getTotalOrdersTodayByUser($user);

        $totalDailyProducts = $orders->reduce(static function($acc, $order) {
            return $acc + $order->productsOrder()->count();
        }, 0);

        return $totalDailyProducts <= config('cantinapp.LIMIT_ORDER_DAILY');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Daily limit order reached..';
    }
}
