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
        $restaurant = \App\Model\Restaurant::where('domain', 'demo')->first();
        if (! $restaurant instanceof \App\Model\Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        \App\User::create([
            'name' => 'Juan Lopez',
            'email' => 'juanlopez@example.com',
            'username' => 'juanlopez',
            'password' => bcrypt('123456'),
            'restaurant_id' => $restaurant->id,
        ]);
    }

}
