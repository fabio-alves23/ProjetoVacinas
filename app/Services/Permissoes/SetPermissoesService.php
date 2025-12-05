<?php

namespace App\Services\Cargos;

use App\Models\Cargos;

class SetPermissoesService
{
    public function run(array $data, Cargos $cargo)
    {
        $cargo->permissoes()->sync($data['permissoes']);
        return $cargo->load('permissoes');
    }
}
