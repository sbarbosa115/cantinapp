<?php

namespace App\Policies;

use App\Model\Restaurant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function all(User $user, Restaurant $restaurant): bool
    {
        return $user->restaurant()->id === $restaurant->id;
    }
}
