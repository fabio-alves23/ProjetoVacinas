<?php

namespace Tests\Feature;

use App\Models\Pet;
use App\Models\Vacina;
use App\Models\PetVacina;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PetVacinaTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_listar_pet_vacinas()
    {
        $this->authenticate();

        $pet = Pet::factory()->create();
        $vacina = Vacina::factory()->create();

        // Criar 3 registros de PetVacina
        PetVacina::factory()->count(3)->create([
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_aplicacao' => now()->toDateString(),
        ]);

        $response = $this->getJson("/api/pets/{$pet->id}/vacinas");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_criar_pet_vacina()
    {
        $this->authenticate();

        $pet = Pet::factory()->create();
        $vacina = Vacina::factory()->create();

        $data = [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_aplicacao' => now()->toDateString(),
        ];

        $response = $this->postJson("/api/pets/{$pet->id}/vacinas", $data);

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

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_atualizar_pet_vacina()
    {
        $this->authenticate();

        $pet = Pet::factory()->create();
        $vacina1 = Vacina::factory()->create();
        $vacina2 = Vacina::factory()->create();

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

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_deletar_pet_vacina()
    {
        $this->authenticate();

        $petVacina = PetVacina::factory()->create();

        $response = $this->deleteJson("/api/petvacinas/{$petVacina->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('pet_vacinas', [
            'id' => $petVacina->id,
        ]);
    }
}
