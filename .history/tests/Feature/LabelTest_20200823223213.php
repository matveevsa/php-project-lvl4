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

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     $this->user = factory(User::class)->create();
    //     $this->be($this->user);

    //     factory(Label::class, 5)->create();
    // }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function create()
    {
        
    }
}
