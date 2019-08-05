<?php

namespace App\Model;

use App\Model\Product\ProductBase;
use App\Model\Taxonomy\Category;
use App\Model\Taxonomy\Tag;
use App\Scopes\ProductByRestaurantScope;
use App\Scopes\ProductEnabledScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
class Product extends Model
{
    protected $fillable = ['name', 'description', 'image_path', 'price', 'slug', 'product_id', 'type'];

    protected $table = 'products';

    public const STATUS_DISABLED = 'disabled';

    public const STATUS_ENABLED = 'enabled';

    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('restaurant', static function ($query) {
            if (session()->has('restaurant_id')) {
                $query->where('restaurant_id', '=', session()->get('restaurant_id'));
            }
        });

        static::addGlobalScope('available', static function ($query) {
            $query->where('status', '=', 'enabled');
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
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_taxonomy', 'product_id', 'taxonomy_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_taxonomy', 'product_id', 'taxonomy_id');
    }

    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class);
    }

}
