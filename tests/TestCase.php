<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $user;

    use CreatesApplication;

    public function signIn($user = null)
    {
        if (! $user) {
            $user = factory(User::class)->create();
        }

        $this->user = $user;

        $this->actingAs($this->user);

        return $this;
    }
}
