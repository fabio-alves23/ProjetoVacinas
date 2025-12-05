<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoPermissoesSeeder extends Seeder
{
    public function run()
    {
        $adminCargoId = 1;

        // Buscar todas permissões
        $permissoes = DB::table('permissoes')->pluck('id');

        // Inserir na pivot cargos_permissoes
        foreach ($permissoes as $permissaoId) {
            DB::table('cargo_permissoes')->insert([
                'permissoes_id' => $permissaoId,
                'cargos_id'     => $adminCargoId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
