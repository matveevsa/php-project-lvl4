<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);

        factory(Task::class, 5)->create(['created_by_id' => $this->user->id]);
    }
    
    public function testExample()
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }
}
