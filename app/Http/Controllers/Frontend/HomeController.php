<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Controller;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Return the app's homepage.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $categories = Taxonomy::where("type", "=", "category")->get();
        $tags = Taxonomy::where("type", "=", "tags")->get();

        return view("frontend.home.index", ["categories" => $categories, "tags" => $tags]);
    }


}
