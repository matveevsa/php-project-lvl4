<?php

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
        DB::table('task_statuses')
            ->insert(
                [
                    [
                        'name' => 'New',
                        'created_at' => now()
                    ],
                    [
                        'name' => 'In progress',
                        'created_at' => now()
                    ],
                    [
                        'name' => 'Done',
                        'created_at' => now()
                    ],
                    [
                        'name' => 'Testing',
                        'created_at' => now()
                    ]
                ]
            );
    }
}
