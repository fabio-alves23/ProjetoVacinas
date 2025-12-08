<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargosSeeder extends Seeder
{
    public function run(): void
    {
        Cargos::create([
            'nome' => 'admin'
        ]);

        Cargos::create([
            'nome' => 'usuario'
        ]);
    }
}
