<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\DomainHandler;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('frontend.home.index', [
            'restaurant' => DomainHandler::getCurrentRestaurant()
        ]);
    }

    public function profile(): View
    {
        return view('frontend.home.my-profile');
    }
}
