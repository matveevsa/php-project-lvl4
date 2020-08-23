<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $task = Task::first();
        $statuses = TaskStatus::select(['id', 'name'])
        ->get()
        ->pluck('name', 'id')
        ->toArray();

        $response = $this->get(route('tasks.edit', [$task, $statuses]));
        $response->assertStatus(200);
    }
}