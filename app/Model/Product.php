<?php

namespace App\Model;

use App\Model\Product\ProductBase;
use Illuminate\Support\Str;

/**
 * @property mixed price
 * @property mixed id
 * @property string comment
 * @property string status
 * @property mixed name
 * @method static create(array $data)
 * @method static find($id)
 * @method static findOrFail(int $id)
 */
class Product extends ProductBase
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'image_path', 'price', 'slug', 'product_id' , 'type'];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(static function ($query) {
            if(session()->has('restaurant_id')) {
                $query->where('restaurant_id', '=', session()->get('restaurant_id'));
            }
        });

        static::creating(static function ($item) {
            if (!$item->restaurant_id) {
                $item->restaurant_id = session()->get('restaurant_id');
            }
        });
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['restaurant_id'] = session('restaurant_id');
    }
}
