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

    public function categories(){
        $categories = Taxonomy::where("type", "=", "category")->with('products')->get();
        return response()->json($categories);
    }

}
