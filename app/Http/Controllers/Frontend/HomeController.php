<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\TaxonomyRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = TaxonomyRepository::getProductsByType();
        return view('frontend.home.index', [
            'categories' => $categories
        ]);
    }
}
