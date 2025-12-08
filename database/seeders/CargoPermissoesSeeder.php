<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargos;
use App\Models\Permissoes;

class CargoPermissoesSeeder extends Seeder
{
    public function run()
    {
        $admin = Cargos::where('nome', 'Administrador')->first();
        $usuario = Cargos::where('nome', 'Usuario')->first();

        // Admin tem TODAS as permissões
        $todas = Permissoes::pluck('id')->toArray();
        $admin->permissoes()->sync($todas);

        // Usuário só pode listar coisas
        $usuario->permissoes()->sync(
            Permissoes::where('nome', 'like', 'index-%')->pluck('id')->toArray()
        );
    }
}
