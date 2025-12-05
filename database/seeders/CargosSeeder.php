<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    public function run()
    {
        DB::table('cargos')->insert([
            [
                'nome' => 'Administrador',
                'description' => 'Acesso total ao sistema',
            ],
            [
                'nome' => 'Atendente',
                'description' => 'Pode gerenciar pets e vacinas',
            ],
        ]);
    }
}
