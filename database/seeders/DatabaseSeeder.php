<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissoesSeeder::class,
            CargosSeeder::class,
            CargoPermissoesSeeder::class,
            UserSeeder::class,
        ]);
    }
}
