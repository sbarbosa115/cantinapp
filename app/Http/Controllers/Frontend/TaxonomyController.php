<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Taxonomy;
use Illuminate\Http\Request;

class TaxonomyController extends Controller

{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('categories');
    }

    /**
     * Return all categories in JSON format with product relationship.
     * @return \Illuminate\Http\JsonResponse
     * @author Sergio Barbosa <sbarbosa115@gmail.com>
     */
    public function categories(){
        $categories = Taxonomy::where("type", "=", "category")->with('products')->get();
        return response()->json($categories);
    }

}
