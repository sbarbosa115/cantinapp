<?php

use App\Model\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{

    public const RESTAURANT_1 = 'demo';

    public const RESTAURANT_2 = 'restaurant-1';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        Restaurant::create([
            'name' => 'Restaurant 1',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'domain' => self::RESTAURANT_1,
        ]);

        Restaurant::create([
            'name' => 'Restaurant 2',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'domain' => self::RESTAURANT_2
        ]);
    }
}
