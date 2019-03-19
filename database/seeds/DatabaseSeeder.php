<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RestaurantSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            TaxonomiesSeeder::class,
            BalanceSeeder::class,
        ]);
    }
}
