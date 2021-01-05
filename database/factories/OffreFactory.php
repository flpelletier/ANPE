<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offre;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Offre::class, function (Faker $faker) {
    return [
        'titre' => $faker->titre,
        'description' => $faker->description,
        'niveau' => $faker->niveau,
        'pdf' => $faker->unique()->pdf,
    ];
});
