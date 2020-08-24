<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Label;
use App\User;

class LabelTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);

        factory(Label::class, 5)->make();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $label = factory(Label::class)->make();

        $response = $this->post(route('labels.store', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', ['name' => $label['name']]);
    }

    public function testEdit()
    {
        $label = Label::first();

        $response = $this->get(route('labels.edit', [$task]));

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

        $response = $this->delete(route('tasks.destroy', $task->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
