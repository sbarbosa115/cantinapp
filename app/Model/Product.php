<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description', 'image_path', 'price', 'slug', 'product_id'];


    /**
     * Generate the product slug.
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Return all taxonomies.
     */
    public function taxonomies(){
        return $this->belongsToMany(Taxonomy::class);
    }


    public function categories(){
        return $this->belongsToMany(Taxonomy::class)->where("type", "=","category");
    }

    public function tags(){
        return $this->belongsToMany(Taxonomy::class)->where("type", "=","tag")->groupBy("taxonomies.slug");
    }

    public function sides(){
        return $this->belongsToMany(Taxonomy::class)->where("type", "=","side");
    }


    /**
     * Return the currency in USD format.
     * @return string
     */
    public function getCurrency(){
        return "$ " . number_format($this->price, 2);
    }

    /**
     * Return the total order by product
     */
    public function getTotalProductOrder(){
        $result = 0;
        if(isset($this->quantity)){
            $result  = $this->quantity * $this->price;
        }
        return $result;
    }

}
