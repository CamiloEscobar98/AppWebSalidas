<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    $role = \App\Models\Role::where('name', 'docente')->first();
    $teacher = $role->users()->get()->random(1)->first();
    return [
        'teacher_id' => $teacher->id,
        'title' => $faker->sentence(10, true),
        'subtitle' => $faker->sentence(6, true),
        'description' => $faker->text(500),
        'place' => $faker->address,
        'date' => $faker->date('Y-m-d', 'now'),
    ];
});
