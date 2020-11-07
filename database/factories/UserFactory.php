<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    $programa = \App\Models\Program::all()->random(1)->first();
    $documento = \App\Models\Document::create([
        'document' => '1090' . $faker->randomNumber(7),
        'document_type_id' => 1,
    ]);
    $image = \App\Models\ImageProfile::create([
        'image' => 'default.png',
        'url' => 'storage/images'
    ]);
    $genero = mt_rand(0, 1);
    $nombres = $faker->firstName($genero);
    $numeros = ['300', '301', '310', '311', '312', '314', '315', '316', '317'];
    $number_selected = mt_rand(0, sizeof($numeros));
    $apellidos = $faker->lastName;
    $code = $programa->code . $faker->unique()->randomNumber(4);
    return [
        'name' => $nombres,
        'lastname' => $apellidos,
        'code' => $code,
        'password' => bcrypt('1234'), // password
        'emailu' => $faker->unique()->safeEmail,
        'email' => $faker->unique()->freeEmail,
        'address' => $faker->address,
        'phone' => $number_selected . $faker->randomNumber(7),
        'birthday' => $faker->date('Y-m-d', '-16 years'),
        'program_id' => $programa->id,
        'document_id' => $documento->id,
        'image_id' => $image->id
    ];
});

$factory->afterCreating(\App\User::class, function ($user, Faker $faker) {
    $role = mt_rand(2, 4);
    $user->roles()->attach($role);
});
