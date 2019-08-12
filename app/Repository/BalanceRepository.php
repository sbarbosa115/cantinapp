<?php

namespace App\Repository;

use App\Model\Balance;
use App\User;
use Illuminate\Support\Collection;

class BalanceRepository
{
    public static function getDebtsByUser(User $user): Collection
    {
        return Balance::where('user_id', $user->id)
            ->where('status', Balance::STATUS_DEBT)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public static function getCustomerOrderLog(User $user): Collection
    {
        return Balance::where('user_id', '=', $user->id)
            ->where('status', '=', Balance::STATUS_SPENT)
            ->orderBy('id', 'asc')
            ->get();
    }
}
