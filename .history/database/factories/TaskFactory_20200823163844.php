<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Task;
use App\TaskStatus;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'status_id' => factory(TaskStatus::class),
        'created_by_id' => factory(User::class),
        'assigned_to_id' => factory(User::class),
        'created_at
    ];
});
