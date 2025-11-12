<?php

namespace Tests\Feature;

use App\Models\Vacina;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VacinaTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
    }

    /** @test */
    public function pode_listar_vacinas()
    {
        $this->authenticate(); // autentica antes de acessar a rota

        Vacina::factory()->count(3)->create();

        $response = $this->getJson('/api/vacinas');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }
    
    /** @test */
    public function pode_criar_uma_vacina()
    {
        $this->authenticate();

        $data = [
            'nome' => 'Vacina Teste',
            'descricao' => 'Descrição da vacina',
            'validade' => now()->addYear()->toDateString(),
        ];

        $response = $this->postJson('/api/vacinas', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Vacina Teste']);

        $this->assertDatabaseHas('vacinas', ['nome' => 'Vacina Teste']);
    }

    /** @test */
    public function pode_atualizar_uma_vacina()
    {
        $this->authenticate();

        $vacina = Vacina::factory()->create([
            'nome' => 'Antiga',
            'validade' => now()->addYear()->toDateString(),
        ]);

        $response = $this->putJson("/api/vacinas/{$vacina->id}", [
            'nome' => 'Nova Vacina',
            'validade' => now()->addYears(2)->toDateString(),
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Nova Vacina']);

        $this->assertDatabaseHas('vacinas', ['nome' => 'Nova Vacina']);
    }

    /** @test */
   /** @test */
public function pode_deletar_uma_vacina()
{
    $this->authenticate();

    $vacina = Vacina::factory()->create([
        'nome' => 'Vacina para deletar',
        'validade' => now()->addYear()->toDateString(),
    ]);

    $response = $this->deleteJson("/api/vacinas/{$vacina->id}");

    $response->assertStatus(204);

    // Como usa SoftDeletes, verificamos se o registro foi "marcado como deletado"
    $this->assertSoftDeleted('vacinas', [
        'id' => $vacina->id,
    ]);
}

}
