<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cargos;

class UserSeeder extends Seeder
{
    public function run()
    {
        $cargoAdmin = Cargos::where('nome', 'Administrador')->first();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@sistema.com',
            'password' => Hash::make('admin123'),
            'cargo_id' => $cargoAdmin->id,
            'is_superadmin' => true,
        ]);
    }
}
