<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_deve_registrar_usuario()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Teste User',
            'email' => 'teste@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => 'teste@example.com',
        ]);
    }

    public function test_deve_fazer_login()
    {
        // cria o usuário manualmente
        User::factory()->create([
            'email' => 'teste@example.com',
            'password' => bcrypt('12345678'),
        ]);

        // tenta logar
        $response = $this->postJson('/api/login', [
            'email' => 'teste@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
    }

    public function test_usuario_logado_acessa_rota_protegida()
    {
        // usa o helper do TestCase para autenticar via Sanctum
        $this->actingAsUser();

        $response = $this->getJson('/api/usuario');

        $response->assertStatus(200);
    }
}
