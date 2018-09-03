<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Taxonomy;
use App\Services\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Controller;
use Illuminate\View\View;


class HomeController extends Controller
{
    public function index(): View
    {
        return view("frontend.home.index");
    }
}
