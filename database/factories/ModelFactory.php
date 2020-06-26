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


    use App\Genre;
    use Faker\Generator;

$factory->define('App\Genre', function (Generator $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define('App\Book', function (Generator $faker) {
    return [
        'title' => $faker->sentence,
        'review' => $faker->paragraph,
        'rating' => $faker->numberBetween(1, 5),
        'genre_id' => function () {
            return create('App\Genre')->id;
        },
    ];
});

$factory->state(App\Book::class, 'from_existing_genres', function (Generator $faker) {
    return [
        'genre_id' => function () {
            return Genre::all()->random()->id;
        },
        'title' => $faker->sentence,
        'review' => $faker->paragraph,
        'rating' => $faker->numberBetween(1, 5),
        'image_path' => null
    ];
});


