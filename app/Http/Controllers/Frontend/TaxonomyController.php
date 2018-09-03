<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Product;
use App\Model\Taxonomy;

class TaxonomyController extends Controller
{

    public function categories()
    {
        $categories = Taxonomy::where("type", "=", "category")->with('products')->get();
        return response()->json($categories);
    }

}
