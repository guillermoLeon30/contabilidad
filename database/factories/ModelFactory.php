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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Color::class, function (Faker\Generator $faker) {
	return [
		'color'			=> $faker->lastName,
		'created_at'	=> $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
		'updated_at'	=> $faker->dateTime($max = 'now', $timezone = date_default_timezone_get())
	];
});

$factory->define(App\ProductMark::class, function (Faker\Generator $faker){
    return [
        'marca'         => $faker->lastName,
        'created_at'    => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at'    => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get())    
    ];
});
