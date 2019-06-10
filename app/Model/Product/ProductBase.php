<?php

namespace App\Model\Product;

use App\Model\Taxonomy\Category;
use App\Model\Taxonomy\Tag;
use App\Model\Taxonomy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class ProductBase extends Model
{
    protected $table = 'products';

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

    public function attachTags(array $tags): void
    {
        $tagsIds = [];
        foreach ($tags as $tagData) {
            $tag = Taxonomy::where('name', $tagData)->where('type', 'tag')->first();
            if (!$tag instanceof Taxonomy) {
                $tag = Taxonomy::create([
                    'name' => $tagData,
                    'type' => 'tag',
                    'description' => 'Created from product.',
                ]);
            }
            $tagsIds[] = $tag->id;
        }
        $this->tags()->sync($tagsIds);
    }
}
