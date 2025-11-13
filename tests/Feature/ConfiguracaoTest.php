<?php

namespace Tests\Feature;

use App\Models\Configuracao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfiguracaoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_listar_configuracoes()
    {
        Configuracao::factory()->create(['nome' => 'modo manutencao', 'valor' => true]);

        $response = $this->getJson('/api/configuracoes');

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'modo manutencao', 'valor' => true]);
    }

    /** @test */
    public function pode_atualizar_configuracao_para_falso()
    {
        Configuracao::factory()->create([
            'nome' => 'modo manutencao',
            'valor' => true,
        ]);

        $response = $this->postJson('/api/configuracoes', [
            'nome' => 'modo manutencao',
            'valor' => false,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['valor' => false]);

        $this->assertDatabaseHas('configuracoes', [
            'nome' => 'modo manutencao',
            'valor' => false,
        ]);
    }

    /** @test */
    public function nao_pode_atualizar_com_valor_invalido()
    {
        Configuracao::factory()->create([
            'nome' => 'modo manutencao',
            'valor' => true,
        ]);

        $response = $this->postJson('/api/configuracoes', [
            'nome' => 'modo manutencao',
            'valor' => 'talvez',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['valor']);
    }
}
