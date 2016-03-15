<?php

$factory->define(App\Modules\User\Models\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'password' => bcrypt(str_random(10)),
    ];
});
