<?php

namespace App\Model\Taxonomy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Tag extends Model
{
    public const TAG = 'tag';

    protected $table = 'taxonomies';

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(static function ($query) {
            $query->where('type', '=', self::TAG);
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
