<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Tests\TestCase;
use App\User;
use App\TaskStatus;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = factory(User::class)->create();
        $this->be($user);

        $this->seed();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $status = TaskStatus::first();
        $response = $this->get(route('task_statuses.edit', $status));
        $response->assertOk();
    }

    public function testStore()
    {
        $taskStatus = factory(TaskStatus::class)
            ->make()
            ->toArray();

        $data = Arr::only($taskStatus, ['name']);

        $response = $this->post(route('task_statuses.store', $data));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $status = TaskStatus::first();
        $factoryStatus = factory(TaskStatus::class)->make()->toArray();

        $data = Arr::only($factoryStatus, ['name']);

        $response = $this->patch(route('task_statuses.update', $status), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $status = TaskStatus::first();

        $response = $this->delete(route('task_statuses.destroy', [$status]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('task_statuses', ['id' => $status->id]);
    }
}
