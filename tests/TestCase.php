<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        return $user;
    }
}
