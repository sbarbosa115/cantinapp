<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class GreaterThanNow implements Rule
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
        $orderDate = Carbon::now();
        $orderDate->setTimeFromTimeString($value);

        $now = Carbon::now();
        return $orderDate > $now;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The given date is lower that current date.';
    }
}
