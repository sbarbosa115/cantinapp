<?php

namespace App\Model\Taxonomy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Category extends Model
{
    public const CATEGORY = 'category';

    protected $table = 'taxonomies';

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(static function ($query) {
            $query->where('type', '=', self::CATEGORY);
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
