<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\User;
use App\TaskStatus;

class TaskTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);

        factory(Task::class, 5)->create(['created_by_id' => $this->user]);
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
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $task = factory(Task::class)
        ->make()
        ->toArray();

        $response = $this->post(route('tasks.store', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

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
        $task = Task::first();
        $data = [
            'name' => 'Test update',
            'status_id' => 2
        ];

        $response = $this->patch(route('tasks.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', ['name' => 'Test update']);
    }

    public function testDestroy()
    {
        $task = Task::where('created_by_id', $this->user->id)->first();
        dd($task);
        $response = $this->delete(route('tasks.destroy', $task->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
