<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Film::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->sentence,
        'affiche' => $faker->imageUrl($width = 640, $height = 480),
        'img' => $faker->imageUrl($width = 200, $height = 480),
        'genre' => $faker->word,
        'note' => $faker->randomDigitNotNull,
        'date' => $faker->dateTimeThisCentury(),
    ];
});
