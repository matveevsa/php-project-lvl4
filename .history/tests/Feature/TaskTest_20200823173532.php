<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\User;
use App\TaskStatus;

class TaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = factory(User::class)->create();
        $this->be($user);

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
        ->create()
        ->toArray();

        $response = $this->post(route('tasks.store', $task));
        $response->assertSessionHasNoErrors();
        // $response->assertRedirect();

        $this->assertDatabaseHas('tasks', ['name' => $task['name']]);
    }

    public function testEdit()
    {
        $task = Task::first();

        $response = $this->get(route('tasks.edit', [$task]));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $task = Task::where('created_by_id', $this->$user->id);
        $task->name = 'Test update';
        $task->save();

        $response = $this->post(route('tasks.update', $task));
        $response->assertSessionHasNoErrors();
        // $response->assertRedirect();

        $this->assertDatabaseHas('tasks', ['name' => $task['name']]);
    }

    public function testDestroy()
    {
        $task = $this->user->tasks();
        dd($task);
        $response = $this->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}