<?php

use App\Model\Restaurant;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public const USER_REGULAR = 'user@example.com';

    public const USER_NO_BALANCE = 'user-2@example.com';

    public const USER_REGULAR_RESTAURANT_B = 'user-3@example.com';

    public const USER_NO_BALANCE_RESTAURANT_B = 'user-4@example.com';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRestaurant1User();
        $this->createRestaurant2User();
    }

    public function createRestaurant1User(): void
    {
        $restaurant = Restaurant::where('domain', RestaurantSeeder::RESTAURANT_1)->first();
        if (! $restaurant instanceof Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        // User for case with balance.
        User::create([
            'name' => 'User With Balance',
            'email' => self::USER_REGULAR,
            'username' => 'user',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);

        // User for case no balance.
        User::create([
            'name' => 'User Without Balance',
            'email' => self::USER_NO_BALANCE,
            'username' => 'user-no-balance',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);
    }

    public function createRestaurant2User(): void
    {
        $restaurant = Restaurant::where('domain', RestaurantSeeder::RESTAURANT_2)->first();
        if (! $restaurant instanceof Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        // User for case with balance.
        User::create([
            'name' => 'User 3 Restaurant 2',
            'email' => self::USER_REGULAR_RESTAURANT_B,
            'username' => 'user-3',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);

        // User for case no balance.
        User::create([
            'name' => 'User 4 Restaurant 2',
            'email' => self::USER_NO_BALANCE_RESTAURANT_B,
            'username' => 'user-4',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);
    }

}
