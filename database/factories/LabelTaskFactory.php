<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LabelTask;
use App\Task;
use App\Label;
use Faker\Generator as Faker;

$factory->define(LabelTask::class, function (Faker $faker) {
    return [
        'label_id' => factory(Task::class),
        'task_id' => factory(Label::class)
    ];
});
