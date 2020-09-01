<?php

use App\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TaskStatus::class)->create(['name' => 'New']);
        factory(TaskStatus::class)->create(['name' => 'In progress']);
        factory(TaskStatus::class)->create(['name' => 'Done']);
        factory(TaskStatus::class)->create(['name' => 'Testing']);
    }
}
