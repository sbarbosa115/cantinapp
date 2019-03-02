<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class TestCase extends BaseCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        Hash::setRounds(4);

        Artisan::call('migrate');
        Artisan::call('db:seed');

        return $app;
    }
}
