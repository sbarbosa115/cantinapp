<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaxonomyRepository {

    public static function getTaxonomiesByType(string $type): Collection
    {
        return DB::table('taxonomies as t')
            ->select('t.*')
            ->where('t.type', '=', $type)
            ->get();
    }

    public static function getCategories(): Collection
    {
        return DB::table('taxonomies')
            ->select(['id', 'type', 'name'])
            ->where('type','category')
            ->orWhere('type', 'side')
            ->get();
    }
}