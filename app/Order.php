<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;

class Order extends Model
{

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = ['pickup_at', 'status', 'image_path', 'user_id', 'payment_method'];

    protected $dates = [
        'pickup_at','created_at','updated_at '
    ];

   /**
    * Return user's (customer) information.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Return all product.
    */
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('product_id', 'order_id', 'quantity', 'comment');
    }

    /**
    * Return the quantity order total items required.
    */
    public function getTotalQuantityOrder(){
        $result = $this->belongsToMany(Product::class)->withPivot('quantity')->pluck("quantity");
        return array_sum($result->toArray());
    }
}
