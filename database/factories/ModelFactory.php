<?php

$factory->define(App\Modules\User\Models\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
