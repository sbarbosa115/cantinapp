<?php

namespace App\Services;

use App\Model\Restaurant;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DomainHandler
{

    public function getCurrentRestaurant(): Restaurant
    {
        $url = parse_url(url()->current());
        $domain = explode('.', $url['host']);
        $restaurant = Restaurant::where('domain', $domain[0])->first();

        if (!$restaurant instanceof Restaurant) {
            throw new NotFoundHttpException('This restaurant was not found.');
        }

        return $restaurant;
    }

    public function getCurrentRestaurantId(): int
    {
        return $this->getCurrentRestaurant()->id;
    }

}
