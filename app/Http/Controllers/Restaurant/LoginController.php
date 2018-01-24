<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view("restaurant.login.login");
    }


    public function login(){
        return redirect()->route("restaurant.product.index");
    }
}
