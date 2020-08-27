<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Label;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence()
    ];
});
