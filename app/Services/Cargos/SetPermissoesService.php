<?php

namespace App\Services\Cargos;

use App\Models\Cargos;

class SetPermissoesService
{
    public function run(Cargos $cargo, array $data)
    {
        $cargo->permissoes()->sync($data['permissoes']);

        return $cargo->load('permissoes');
    }
}
