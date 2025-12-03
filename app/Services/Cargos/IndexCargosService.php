<?php

namespace App\Services\Cargo;

use App\Models\Cargos;

class IndexCargosService
{
    public function run()
    {
        return Cargos::orderBy('nome')->paginate(10);
    }
}
