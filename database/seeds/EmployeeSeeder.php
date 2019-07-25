<?php

use App\Model\Employee;
use App\Model\Restaurant;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant = Restaurant::where('domain', 'demo')->first();
        if (! $restaurant instanceof Restaurant) {
            throw new InvalidArgumentException('Restaurant not was found');
        }

        Employee::create([
            'name' => 'Frank Rodriguez',
            'email' => 'frank@example.com',
            'username' => 'frank',
            'password' => '123456',
            'restaurant_id' => $restaurant->id,
        ]);
    }

}
