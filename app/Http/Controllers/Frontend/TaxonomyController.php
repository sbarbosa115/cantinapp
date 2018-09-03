<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Taxonomy;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyController extends Controller
{

    public function categories(): Response
    {
        $categories = Taxonomy::where("type", "=", "category")->with('products')->get();
        return response()->json($categories);
    }

}
