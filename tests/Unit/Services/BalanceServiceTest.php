<?php

namespace Tests\Unit;

use App\Facades\BalanceService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BalanceServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testAddBalanceToUser(): void
    {
        $user = $this->getUser();
        $originalBalances = $user->balances()->get()->count();

        BalanceService::addUserBalance($user, 5);
        $newBalance = $originalBalances + 5;
        $this->assertEquals($user->balances()->get()->count(), $newBalance);
    }
}
