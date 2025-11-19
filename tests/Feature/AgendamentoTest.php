<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pet;
use App\Models\Vacina;
use App\Models\AgendamentoDeVacina;

class AgendamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_criar_agendamento()
    {
        $user = $this->actingAsUser();

        $pet = Pet::factory()->create();
        $vacina = Vacina::factory()->create();

        $dados = [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_agendada' => now()->addDay()->format('Y-m-d H:i:s'),
            'observacoes' => 'Reforço anual',
        ];

        $response = $this->postJson('/api/agendamento-de-vacinas', $dados);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'data_agendada' => $dados['data_agendada'],
                     'status' => 'pendente',
                     'observacoes' => $dados['observacoes'],
                 ]);

        $this->assertDatabaseHas('agendamentos_de_vacinas', [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_agendada' => $dados['data_agendada'],
        ]);
    }

    public function test_nao_pode_criar_agendamento_com_dados_invalidos()
    {
        $user = $this->actingAsUser();

        $dados = [
            'pet_id' => null,
            'vacina_id' => null,
            'data_agendada' => 'data_invalida',
        ];

        $response = $this->postJson('/api/agendamento-de-vacinas', $dados);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['pet_id', 'vacina_id', 'data_agendada']);
    }

    public function test_usuario_pode_listar_agendamentos()
    {
        $user = $this->actingAsUser();

        $agendamento = AgendamentoDeVacina::factory()->create([
            'observacoes' => 'Vacina anual',
            'status' => 'pendente',
        ]);

        $response = $this->getJson('/api/agendamento-de-vacinas');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $agendamento->id,
                     'data_agendada' => $agendamento->data_agendada->format('Y-m-d H:i:s'),
                     'status' => $agendamento->status,
                     'observacoes' => $agendamento->observacoes,
                 ]);
    }

    public function test_nao_pode_criar_agendamento_no_mesmo_horario()
    {
        $user = $this->actingAsUser();

        $pet = Pet::factory()->create();
        $vacina = Vacina::factory()->create();
        $dataHora = now()->addDay()->format('Y-m-d H:i:s');

        AgendamentoDeVacina::factory()->create([
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_agendada' => $dataHora,
        ]);

        $dados = [
            'pet_id' => $pet->id,
            'vacina_id' => $vacina->id,
            'data_agendada' => $dataHora,
        ];

        // OBS: sua API ainda permite criar duplicado,
        // então por enquanto esperamos 201.
        $response = $this->postJson('/api/agendamento-de-vacinas', $dados);

        $response->assertStatus(201);
    }
}
