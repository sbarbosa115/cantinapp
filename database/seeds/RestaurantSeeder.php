<?php

use App\Model\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        Restaurant::create([
            'name' => 'Demo',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'domain' => 'demo'
        ]);
    }
}
