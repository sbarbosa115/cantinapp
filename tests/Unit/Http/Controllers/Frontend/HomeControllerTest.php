<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    public function testProtectedRoutes(): void
    {
        $this->loginAsUser();

        $urls = [
            route('frontend.order.index'),
            route('frontend.order.profile'),
        ];

        foreach ($urls as $url) {
            $response = $this->call('GET', url($url));
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        }
    }

}
