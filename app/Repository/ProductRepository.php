<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository {

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
        $sidesCategories = TaxonomyRepository::getTaxonomiesByType('side');
        $result = new Collection();
        foreach ($sidesCategories as $side){
            $result->put($side->slug, self::getSidesBySlug($side->slug));
        }

        return $result;
    }

}