<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\ProductRepository;
use App\Repositories\TaxonomyRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = TaxonomyRepository::getProductsByType();
        $sides = ProductRepository::getSides();
        return view('frontend.home.index', [
            'categories' => $categories,
            'sides' => $sides,
        ]);
    }

    public function profile(): View
    {
        return view('frontend.home.my-profile');
    }
}
