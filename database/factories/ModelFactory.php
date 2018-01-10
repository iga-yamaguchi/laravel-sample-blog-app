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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => $faker->unique()->name,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
    $nameWithExtension = $name . '.png';
    $imageAbsolutePath = storage_path('uploads/' . $nameWithExtension);
    copy(resource_path('assets/images/640x480.png'), $imageAbsolutePath);

    return [
        'title'      => $faker->title,
        'content'    => $faker->text(191),
        'image_path' => $nameWithExtension,
    ];
});
