<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Symfony\Component\Debug\Exception\ClassNotFoundException;

/**
 * @property mixed price
 * @method static create(array $data)
 * @method static find($id)
 * @method static findOrFail(int $id)
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description', 'image_path', 'price', 'slug', 'product_id'];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('restaurant_id', '=', session('restaurant_id'));
        });
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
        $this->attributes['restaurant_id'] = session('restaurant_id');
    }

    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->whereIn('type',['category', 'side'], 'or');
    }

    public function category()
    {
       return $this->belongsToMany(Taxonomy::class)->whereIn('type',['category', 'side']);
    }

    public function tags(){
        return $this->belongsToMany(Taxonomy::class)->where('type', '=','tag');
    }

    public function getCurrency(): String
    {
        return '$ ' . number_format($this->price, 2);
    }

    public function getTotalProductOrder(){
        $result = 0;
        if(isset($this->quantity)){
            $result  = $this->quantity * $this->price;
        }
        return $result;
    }

    protected function attachTags(string $stringTags): array
    {
        $tags = \json_decode($stringTags, true);
        $taxonomiesIds = [];
        foreach ($tags as $tag){
            $taxonomy = Taxonomy::where('name', $tag)->where('type', 'tag')->first();
            if(!$taxonomy){
                $taxonomy = Taxonomy::create([
                    'name' => $tag,
                    'type' => 'tag',
                    'description' => 'Created from product.'
                ]);
            }
            $taxonomiesIds[] = $taxonomy->id;
        }
        return $taxonomiesIds;
    }

    protected function attachCategory(int $category): array
    {
        $taxonomy = Taxonomy::find($category);
        if(!$taxonomy instanceof Taxonomy){
            throw new ClassNotFoundException('Invalid category id');
        }
        return [$taxonomy->id];
    }

    public function attachTaxonomies(string $tags, string $category): void
    {
        $tags = $this->attachTags($tags);
        $taxonomies = array_merge($tags, $this->attachCategory($category));
        $this->tags()->sync($taxonomies);
    }
}
