<?php

namespace App\Services\Cargos;

use App\Models\Cargos;

class DeleteCargosService
{
    public function run(int $id)
    {
        $cargos = Cargos::findOrFail($id);
        $cargos->delete();
    }
}
