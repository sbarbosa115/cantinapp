<?php

namespace App\Http\Requests;

use App\Rules\GreaterThanNow;
use App\Rules\MaxOrderDate;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pickup_at' => [
                'required', 'date_format:H:i', new GreaterThanNow(), new MaxOrderDate(),
            ],
            'id'  => [
                'required'
            ],
            'sides' => [
                'required', 'array'
            ],
        ];
    }
}
