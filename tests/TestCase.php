<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Pet;
use App\Models\Vacina;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        return $user;
    }

    protected function createPet()
    {
        return Pet::factory()->create();
    }

    protected function createVacina()
    {
        return Vacina::factory()->create();
    }
}
