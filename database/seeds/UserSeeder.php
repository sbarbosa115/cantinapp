<?php

use App\Model\Restaurant;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** @var $restaurant Restaurant */
    protected $restaurant;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant = Restaurant::where('domain', 'demo')->first();
        if (! $restaurant instanceof Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        // User for case with balance.
        User::create([
            'name' => 'User With Balance',
            'email' => 'user@example.com',
            'username' => 'user',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);

        // User for case no balance.
        User::create([
            'name' => 'User Without Balance',
            'email' => 'user-2@example.com',
            'username' => 'user-no-balance',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);
    }

}
