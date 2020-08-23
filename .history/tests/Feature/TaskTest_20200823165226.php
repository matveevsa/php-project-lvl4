<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\TaskStatus;

class TaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        factory(Task::class, 5)->create();
    }
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

    public function testStore()
    {
        $task = factory(Task::class)
        ->create(['name' => 'Task test name'])
        ->toArray();

        $response = $this->post(route('tasks.store', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [$task);
    }

    public function testEdit()
    {
        $task = Task::first();

        $response = $this->get(route('tasks.edit', [$task]));

        $response->assertStatus(200);
    }
}
