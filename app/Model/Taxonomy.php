<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'type'];

    /**
     * Return all product.
     */
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    /**
     * Generate the product slug.
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

}
