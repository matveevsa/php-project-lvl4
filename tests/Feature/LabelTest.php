<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Label;
use App\User;

class LabelTest extends TestCase
{
    use WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);

        factory(Label::class, 5)->create();
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
        $label = factory(Label::class)
            ->make()
            ->toArray();

        $response = $this->post(route('labels.store', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', ['name' => $label['name']]);
    }

    public function testEdit()
    {
        $label = Label::first();

        $response = $this->get(route('labels.edit', $label));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $label = Label::first();
        $data = [
            'name' => 'Test update',
            'description' => $this->faker->sentence()
        ];

        $response = $this->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', ['name' => $data['name']]);
    }

    public function testDestroy()
    {
        $label = Label::first();

        $response = $this->delete(route('labels.destroy', $label->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('labels', ['id' => $label->id]);
    }
}
