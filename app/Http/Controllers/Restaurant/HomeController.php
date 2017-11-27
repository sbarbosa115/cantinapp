<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     *
     */
    public function index(){
        return view('restaurant.home.index');
    }
}
