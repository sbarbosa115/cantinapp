<?php

namespace App\Http\Requests;

use App\Rules\DailyLimitOrder;
use App\Rules\GreaterThanNow;
use App\Rules\MaxOrderDate;
use App\Rules\ProductExist;
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
            'products' => [
                'required',
                sprintf('between:1,%s', config('cantinapp.LIMIT_DISHES_BY_ORDER')),
                new DailyLimitOrder()
            ],
            'products.*.product_id' => 'required|numeric', new ProductExist(),
            'products.*.sides' => 'required|array',
            'products.*.sides.*' => 'integer',
            'products.*.beverages' => 'required|array',
            'products.*.beverages.*' => 'integer',
            'products.*.comment' => 'nullable',
        ];
    }
}
