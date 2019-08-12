<?php

namespace App\Http\Controllers\Frontend;
;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('frontend.home.index');
    }

    public function profile(): View
    {
        return view('frontend.home.my-profile');
    }
}
