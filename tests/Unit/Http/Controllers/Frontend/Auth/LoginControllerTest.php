<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    public function testLoginFrontend(): void
    {
        $this->post(route('frontend.login'), $this->userCredentials)
            ->assertRedirect(route('frontend.home.index'));
    }

}
