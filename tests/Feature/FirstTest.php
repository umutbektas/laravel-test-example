<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FirstTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test  */
    public function example()
    {
        $this->get('/')
            ->assertSee('Docs');

    }
}
