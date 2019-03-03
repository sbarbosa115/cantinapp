<?php

use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        \App\Model\Restaurant::create([
            'name' => 'Demo',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'domain' => 'demo'
        ]);
    }
}
