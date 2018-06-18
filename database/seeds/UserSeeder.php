<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUser();
        $this->createEmployee();
    }

    public function createUser(): void
    {
        \App\User::create([
            'name' => 'Juan Lopez',
            'email' => 'juanlopez@example.com',
            'username' => 'juanlopez',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
    }

    public function createEmployee(): void
    {
        $faker = Faker\Factory::create();

        $restaurant = \App\Model\Restaurant::create([
            'name' => 'Top 1 Restaurant',
            'phone' => $faker->phoneNumber,
            'lat' => $faker->latitude,
            'lon' => $faker->longitude,
            'address' => $faker->address
        ]);

        \App\Model\Employee::create([
            'name' => 'Frank Rodriguez',
            'email' => 'frank@example.com',
            'username' => 'frank',
            'identification' => 9909,
            'password' => '123456',
            'remember_token' => str_random(10),
            'restaurant_id' => $restaurant->id,
        ]);
    }
}
