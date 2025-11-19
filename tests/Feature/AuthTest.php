<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    }

    public function test_deve_fazer_login()
    {
        // primeiro registra o usuário
        $this->postJson('/api/register', [
            'name' => 'Teste User',
            'email' => 'teste@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        // tenta logar
        $response = $this->postJson('/api/login', [
            'email' => 'teste@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
    }
}
