<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Taxonomy extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'type'];

    public const TYPE_TAG = 'tag';

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['restaurant_id'] = session('restaurant_id');
    }
}
