<?php

namespace Tests\Feature;

use App\Models\PetVacina;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetVacinaTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_listar_pet_vacinas()
    {
        $user = $this->actingAsUser();

        $pet = $this->createPet();
        $vacina = $this->createVacina();

        PetVacina::factory()->count(3)->create([
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_aplicacao' => now()->toDateString(),
        ]);

        $response = $this->getJson("/api/pets/{$pet->id}/vacinas");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_pode_criar_pet_vacina()
    {
        $user = $this->actingAsUser();

        $pet = $this->createPet();
        $vacina = $this->createVacina();

        $dados = [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_aplicacao' => now()->toDateString(),
        ];

        $response = $this->postJson("/api/pets/{$pet->id}/vacinas", $dados);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'pet_id' => $pet->id,
                     'vacina_id' => $vacina->id,
                 ]);

        $this->assertDatabaseHas('pet_vacinas', [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
        ]);
    }

    public function test_pode_atualizar_pet_vacina()
    {
        $user = $this->actingAsUser();

        $pet = $this->createPet();
        $vacina1 = $this->createVacina();
        $vacina2 = $this->createVacina();

        $petVacina = PetVacina::factory()->create([
            'pet_id' => $pet->id,
            'vacina_id' => $vacina1->id,
            'data_aplicacao' => now()->toDateString(),
        ]);

        $response = $this->putJson("/api/petvacinas/{$petVacina->id}", [
            'vacina_id' => $vacina2->id,
            'data_aplicacao' => now()->addDays(10)->toDateString(),
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'vacina_id' => $vacina2->id,
                 ]);

        $this->assertDatabaseHas('pet_vacinas', [
            'id' => $petVacina->id,
            'vacina_id' => $vacina2->id,
        ]);
    }

    public function test_pode_deletar_pet_vacina()
    {
        $user = $this->actingAsUser();

        $petVacina = PetVacina::factory()->create();

        $response = $this->deleteJson("/api/petvacinas/{$petVacina->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('pet_vacinas', [
            'id' => $petVacina->id,
        ]);
    }
}
