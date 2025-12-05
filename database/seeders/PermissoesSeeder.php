<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissoesSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissoes')->insert([

            // ================================
            // Permissões de Usuários
            // ================================
            [
                'name' => 'index-users',
                'description' => 'Listar usuários',
            ],
            [
                'name' => 'store-users',
                'description' => 'Criar usuários',
            ],
            [
                'name' => 'update-users',
                'description' => 'Atualizar usuários',
            ],
            [
                'name' => 'delete-users',
                'description' => 'Deletar usuários',
            ],

            // ================================
            // Permissões de Pets
            // ================================
            [
                'name' => 'index-pets',
                'description' => 'Listar pets',
            ],
            [
                'name' => 'store-pets',
                'description' => 'Criar pets',
            ],
            [
                'name' => 'update-pets',
                'description' => 'Atualizar pets',
            ],
            [
                'name' => 'delete-pets',
                'description' => 'Excluir pets',
            ],

            // ================================
            // Permissões de Vacinas
            // ================================
            [
                'name' => 'index-vacinas',
                'description' => 'Listar vacinas',
            ],
            [
                'name' => 'store-vacinas',
                'description' => 'Criar vacinas',
            ],
            [
                'name' => 'update-vacinas',
                'description' => 'Atualizar vacinas',
            ],
            [
                'name' => 'delete-vacinas',
                'description' => 'Excluir vacinas',
            ],

            // ================================
            // Permissões Pet-Vacina
            // ================================
            [
                'name' => 'index-petvacinas',
                'description' => 'Listar vacinas aplicadas ao pet',
            ],
            [
                'name' => 'store-petvacinas',
                'description' => 'Aplicar vacina ao pet',
            ],
            [
                'name' => 'update-petvacinas',
                'description' => 'Atualizar vacina aplicada ao pet',
            ],
            [
                'name' => 'delete-petvacinas',
                'description' => 'Remover vacina aplicada ao pet',
            ],

            // ================================
            // Permissões Agendamentos
            // ================================
            [
                'name' => 'index-agendamentos',
                'description' => 'Listar agendamentos',
            ],
            [
                'name' => 'store-agendamentos',
                'description' => 'Criar agendamento',
            ],
            [
                'name' => 'update-agendamentos',
                'description' => 'Atualizar agendamento',
            ],
            [
                'name' => 'delete-agendamentos',
                'description' => 'Excluir agendamento',
            ],

            // Permissão especial
            [
                'name' => 'relatorio-atrasados',
                'description' => 'Gerar relatório de agendamentos atrasados',
            ],

            // ================================
            // Permissões de Cargos
            // ================================
            [
                'name' => 'index-cargos',
                'description' => 'Listar cargos',
            ],
            [
                'name' => 'store-cargos',
                'description' => 'Criar cargo',
            ],
            [
                'name' => 'update-cargos',
                'description' => 'Atualizar cargo',
            ],
            [
                'name' => 'delete-cargos',
                'description' => 'Excluir cargo',
            ],
            [
                'name' => 'setar-permissoes',
                'description' => 'Definir permissões para um cargo',
            ],

        ]);
    }
}
