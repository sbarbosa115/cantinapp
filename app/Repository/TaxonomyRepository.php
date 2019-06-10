<?php

namespace App\Repositories;

use App\Model\Taxonomy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaxonomyRepository
{
    public static function getTaxonomiesByType(string $type): Collection
    {
        return DB::table('taxonomies as t')
            ->select('t.*')
            ->where('t.type', '=', $type)
            ->get();
    }

    public static function getProductsByType(
        string $taxonomyType = 'category',
        string $taxonomyName = 'meals'
    ): Collection {
        $taxonomyIds = DB::table('products')
            ->selectRaw('DISTINCT(taxonomies.id) as taxonomy_id')
            ->join('product_taxonomy', 'product_taxonomy.product_id', '=', 'products.id')
            ->join('taxonomies', 'product_taxonomy.taxonomy_id', '=', 'taxonomies.id')
            ->where('taxonomies.type', $taxonomyType)
            ->where('taxonomies.name', $taxonomyName)
            ->get()->pluck('taxonomy_id')->toArray();

        return Taxonomy::whereIn('id', $taxonomyIds)
            ->with('products')
            ->with('products.taxonomies')
            ->get();
    }
}
