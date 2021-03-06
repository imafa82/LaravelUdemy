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
use Carbon\Carbon;
use App\Models\Album;
use App\User;
use App\Models\Photo;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Album::class, function (Faker\Generator $faker) {
    
    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'user_id' => User::inRandomOrder()->first()->id,
        'album_thumb' => $faker->imageUrl(120, 120, $faker->randomElement(['cats', 'abstract', 'animals', 'business', 'city', 'food', 'fashion', 'sports', 'technics', 'transport']))
    ];
});

$factory->define(App\Models\Photo::class, function (Faker\Generator $faker) {
    
    return [
        //'album_id' => Album::inRandomOrder()->first()->id,
        'album_id' => 1,
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'img_path' => $faker->imageUrl(640, 480, $faker->randomElement(['cats', 'abstract', 'animals', 'business', 'city', 'food', 'fashion', 'sports', 'technics', 'transport']))
    ];
});