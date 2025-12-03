<?php

namespace App\Services\Cargo;

use App\Models\Cargos;

class UpdateCargosService
{
    public function run(array $data, Cargos $cargos)
    {
        $cargos->update($data);
        return $cargos;
    }
}
