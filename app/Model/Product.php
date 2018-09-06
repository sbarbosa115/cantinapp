<?php

namespace App\Model;

use App\Repositories\TaxonomyRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed price
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description', 'image_path', 'price', 'slug', 'product_id'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function taxonomies(){
        return $this->belongsToMany(Taxonomy::class);
    }

    public function categories(){
        return $this->belongsTo(Taxonomy::class)->whereIn("type",["category", "side"], 'or');
    }

    public function tags(){
        return $this->belongsToMany(Taxonomy::class)->where("type", "=","tag");
    }

    public function getCurrency(){
        return "$ " . number_format($this->price, 2);
    }

    public function getTotalProductOrder(){
        $result = 0;
        if(isset($this->quantity)){
            $result  = $this->quantity * $this->price;
        }
        return $result;
    }

    public function attachTags(string $stringTags)
    {
        $tags = json_decode($stringTags, true);
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
        $this->tags()->sync($taxonomiesIds);
    }

}
