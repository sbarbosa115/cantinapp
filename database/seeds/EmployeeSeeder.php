<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant = \App\Model\Restaurant::where('domain', 'demo')->first();
        if (! $restaurant instanceof \App\Model\Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        \App\Model\Employee::create([
            'name' => 'Frank Rodriguez',
            'email' => 'frank@example.com',
            'username' => 'frank',
            'password' => '123456',
            'restaurant_id' => $restaurant->id,
        ]);
    }

}
