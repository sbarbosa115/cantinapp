<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    public function testPublicRoutes(): void
    {
        $urls = [
            '/',
            '/login',
            '/register',
        ];

        foreach ($urls as $url) {
            $response = $this->call('GET', url($url));
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        }
    }

}
