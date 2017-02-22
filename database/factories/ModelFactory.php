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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'type' => 'staff',
        'role' => 'HOD',
        'phone' => $faker->phoneNumber,
        'department_id' => 1,
        'date_employed'=> $faker->dateTimeThisDecade($max = 'now'),
        'DOB'=> $faker->dateTimeThisCentury($max = 'now'),
        'gender' => 'male',
        'marital_status' => 'married',
        'password' => '123456',
        'remember_token' => str_random(10),
    ];
});

 
$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
    'name' => 'Human resource',
    'HOD' => 21, 

    ];
});