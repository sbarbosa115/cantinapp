<?php

namespace App\Model;

use App\Product;
use App\Order;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'order_id', 'status'];


    /**
     * Get the product record associated with the balance record.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product record associated with the balance record.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user record associated with the balance record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function getOrderAttribute($attribute){
        if($this->order()->exists()){
            return $this->order()->first()->{$attribute};
        }
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function getProductAttribute($attribute){
        if($this->product()->exists()){
            return $this->product()->first()->{$attribute};
        }
    }
}
