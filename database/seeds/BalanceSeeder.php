<?php

use Illuminate\Database\Seeder;
use App\Model\Balance;
use App\User;


class BalanceSeeder extends Seeder
{
    private const INITIAL_USER_BALANCE = 5;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('email', [
            UserSeeder::USER_REGULAR, UserSeeder::USER_REGULAR_RESTAURANT_B
        ])->get();

        foreach ($users as $user) {
            for ($i = 0; $i < self::INITIAL_USER_BALANCE; ++$i) {
                Balance::create([
                    'user_id' => $user->id,
                    'status' => Balance::STATUS_AVAILABLE,
                ]);
            }
        }
    }

}
