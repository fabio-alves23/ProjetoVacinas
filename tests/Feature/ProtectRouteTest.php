<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProtectedRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_acessa_rota_protegida()
    {
        // Cria um usuário de teste
        $user = User::factory()->create();

        // Gera token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Faz uma requisição autenticada à rota /api/usuario
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson('/api/usuario');

        // Deve retornar 200 (OK)
        $response->assertStatus(200);
    }

    public function test_usuario_nao_autenticado_nao_acessa_rota_protegida()
    {
        // Acessa a rota sem token
        $response = $this->getJson('/api/usuario');

        // Deve retornar 401 (não autorizado)
        $response->assertStatus(401);
    }
}
