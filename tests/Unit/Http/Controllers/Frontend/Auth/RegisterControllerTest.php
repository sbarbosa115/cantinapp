<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    static private $newUserToRegister = [
        'name' => 'NEW_TEST_USER',
        'email' => 'NEW_TEST_USER@example.com',
        'password' => '123456',
    ];

    public function testRegisterFrontend(): void
    {
        $this->post(route('frontend.register'), self::$newUserToRegister)
            ->assertRedirect(route('frontend.home.index'));
    }

}
