<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pet;

class PetTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_pode_criar_pet()
    {
        $user = $this->actingAsUser();

        $payload = [
            'name' => 'Rex',
            'species' => 'Cachorro',
            'breed' => 'Labrador',
            'birthdate' => '2020-05-01',
        ];

        $response = $this->postJson('/api/pets', $payload);

        $response->assertStatus(201)
                 ->assertJsonPath('name', 'Rex');

        $this->assertDatabaseHas('pets', [
            'name' => 'Rex',
            'user_id' => $user->id,
        ]);
    }

    public function test_usuario_autenticado_pode_listar_pets()
    {
        $user = $this->actingAsUser();

        Pet::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/pets');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_usuario_autenticado_pode_ver_detalhes_do_pet()
    {
        $user = $this->actingAsUser();

        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Rex'
        ]);

        $response = $this->getJson("/api/pets/{$pet->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Rex');
    }

    public function test_usuario_autenticado_pode_deletar_pet()
    {
        $user = $this->actingAsUser();

        $pet = Pet::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/pets/{$pet->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Pet deletado com sucesso!']);

        $this->assertSoftDeleted('pets', ['id' => $pet->id]);
    }
}
