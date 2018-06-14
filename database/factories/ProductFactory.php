<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(200),
        'image_path' =>  "/uploads/67bead9a4203c3fa8a93e7342d5cf73c.jpg",
        'price' => mt_rand(7, 20),
    ];
});

