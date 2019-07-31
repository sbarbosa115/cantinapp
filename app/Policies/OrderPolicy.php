<?php

namespace App\Policies;

use App\User;

class OrderPolicy
{

    public function create(User $user): bool
    {
        return ($user->allOrders()->count() > 0)
            || ($user->allOrders()->count() === 0 && $user->balances()->count() > 0);
    }
}
