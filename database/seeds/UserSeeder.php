<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** @var $restaurant \App\Model\Restaurant */
    protected $restaurant;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRestaurant();
        $this->createUser();
        $this->createEmployee();
    }

    public function createRestaurant(): void
    {
        $faker = Faker\Factory::create();

        $this->restaurant = \App\Model\Restaurant::create([
            'name' => 'Demo',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'domain' => 'demo'
        ]);
    }

    public function createUser(): void
    {
        \App\User::create([
            'name' => 'Juan Lopez',
            'email' => 'juanlopez@example.com',
            'username' => 'juanlopez',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'restaurant_id' => $this->restaurant->id,
        ]);
    }

    public function createEmployee(): void
    {
        \App\Model\Employee::create([
            'name' => 'Frank Rodriguez',
            'email' => 'frank@example.com',
            'username' => 'frank',
            'password' => '123456',
            'restaurant_id' => $this->restaurant->id,
        ]);
    }
}
