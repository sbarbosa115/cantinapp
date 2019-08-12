<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_DEBT = 'debt';
    public const STATUS_SPENT = 'spent';

    protected $fillable = ['user_id', 'product_id', 'order_id', 'status', 'invoice'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderAttribute($attribute)
    {
        if ($this->order()->exists()) {
            return $this->order()->first()->{$attribute};
        }
    }

    public function getProductAttribute($attribute)
    {
        if ($this->product()->exists()) {
            return $this->product()->first()->{$attribute};
        }
    }
}
