<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class TestCase extends BaseCase
{
    use RefreshDatabase;

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/test.php';

        $kernel = $app->make(Kernel::class);

        $kernel->call('migrate');
        $kernel->call('db:seed');

        $kernel->bootstrap();

        Hash::setRounds(4);

        return $app;
    }
}
