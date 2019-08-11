<?php

namespace App\Http\Middleware;

use App\Facades\DomainHandler;
use Closure;
use Symfony\Component\HttpFoundation\Request;

class AddSubdomainToSession
{
    public function handle(Request $request, Closure $next)
    {
        $restaurant = DomainHandler::getCurrentRestaurant();
        $request->session()->put('restaurant', $restaurant);
        $request->session()->put('restaurant_id', $restaurant->id);

        return $next($request);
    }
}
