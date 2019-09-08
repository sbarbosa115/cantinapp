<?php

namespace App\Rules;

use App\Model\Product;
use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductExist implements Rule
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
        /** @var $user User */
        $user = Auth::user();

        $product = Product::where('id', $value)
            ->where('restaurant_id', $user->restaurant->id)
            ->where('status', Product::STATUS_ENABLED)
            ->first();

        return $product instanceof Product;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Either, product does not exist or is not enabled.';
    }
}
