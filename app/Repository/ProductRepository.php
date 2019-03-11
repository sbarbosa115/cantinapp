<?php

namespace App\Repositories;

use App\Model\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public static function getAllProductsBySide(string $type = 'side'): Collection
    {
        return DB::table('products as p')
            ->select('p.*')
            ->join('product_taxonomy as pt', 'p.id', '=', 'pt.product_id')
            ->join('taxonomies as t', 'pt.taxonomy_id', '=', 't.id')
            ->where('t.type', '=', $type)
            ->get();
    }

    public static function getSidesBySlug(string $name): Collection
    {
        return DB::table('products as p')
            ->select('p.*')
            ->join('product_taxonomy as pt', 'p.id', '=', 'pt.product_id')
            ->join('taxonomies as t', 'pt.taxonomy_id', '=', 't.id')
            ->where('t.type', '=', 'side')
            ->where('t.slug', '=', $name)
            ->get();
    }

    public static function getAllProductsBySideGrouped(): Collection
    {
        $sidesCategories = TaxonomyRepository::getProductsByType('tag', 'side');
        $result = collect();
        foreach ($sidesCategories as $category) {
            foreach ($category->products()->get() as $product) {
                $result->put($product->slug, $product);
            }
        }

        return $result;
    }

    public static function getSides(): Collection
    {
        $productsStdClass = DB::table('products as p')
            ->select(['p.*', 't.slug'])
            ->join('product_taxonomy as pt', 'p.id', '=', 'pt.product_id')
            ->join('taxonomies as t', 'pt.taxonomy_id', '=', 't.id')
            ->where('t.type', '=', 'category')
            ->where('t.name', '=', 'side')
            ->get()
            ->toArray();

        return Product::hydrate($productsStdClass)->filter(function(Product $product) {
            $product->tags = $product->tags()->get()->toArray();
            return $product;
        });
    }
}
