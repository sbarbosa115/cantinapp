<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    public function sides(){
        return $this->hasMany(Side::class);
    }

    public function sidesAsString(){
        $sides = $this->hasMany(Side::class)->get();
        $result = [];

        foreach ($sides as $side){
            $result[] = $side->products()->name;
        }

        return implode(',', $result);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id')->get()->first();
    }
}
