<?php

namespace Tests\Feature;

use App\Models\Vacina;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacinaTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_pode_listar_vacinas()
    {
        $user = $this->actingAsUser();

        Vacina::factory()->count(3)->create();

        $response = $this->getJson('/api/vacinas');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_usuario_autenticado_pode_criar_vacina()
    {
        $user = $this->actingAsUser();

        $data = [
            'nome' => 'Vacina Teste',
            'descricao' => 'Descrição da vacina',
            'validade' => now()->addYear()->toDateString(),
        ];

        $response = $this->postJson('/api/vacinas', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Vacina Teste']);

        $this->assertDatabaseHas('vacinas', [
            'nome' => 'Vacina Teste'
        ]);
    }

    public function test_usuario_autenticado_pode_atualizar_vacina()
    {
        $user = $this->actingAsUser();

        $vacina = Vacina::factory()->create([
            'nome' => 'Vacina Antiga',
            'validade' => now()->addYear()->toDateString(),
        ]);

        $response = $this->putJson("/api/vacinas/{$vacina->id}", [
            'nome' => 'Vacina Atualizada',
            'validade' => now()->addYears(2)->toDateString(),
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Vacina Atualizada']);

        $this->assertDatabaseHas('vacinas', [
            'id'   => $vacina->id,
            'nome' => 'Vacina Atualizada',
        ]);
    }

    public function test_usuario_autenticado_pode_deletar_vacina()
    {
        $user = $this->actingAsUser();

        $vacina = $this->createVacina();

        $response = $this->deleteJson("/api/vacinas/{$vacina->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('vacinas', [
            'id' => $vacina->id,
        ]);
    }
}
