<?php

namespace App\Model;

use App\Model\Order;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'order_id', 'status'];


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
        if($this->order()->exists()){
            return $this->order()->first()->{$attribute};
        }
    }

    public function getProductAttribute($attribute)
    {
        if($this->product()->exists()){
            return $this->product()->first()->{$attribute};
        }
    }
}
