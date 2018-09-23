<?php

namespace App\Http\Middleware;

use App\Model\Restaurant;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddSubdomainToSession
{

    public function handle(Request $request, Closure $next)
    {
        $url = parse_url(url()->current());
        $domain = explode('.', $url['host']);
        $restaurant = Restaurant::where('domain', $domain{0})->first();

        if(!$restaurant instanceof Restaurant){
            throw new NotFoundHttpException('This restaurant was not found.');
        }

        $request->session()->put('restaurant', $restaurant);
        $request->session()->put('restaurant_id', $restaurant->id);

        return $next($request);
    }
}
