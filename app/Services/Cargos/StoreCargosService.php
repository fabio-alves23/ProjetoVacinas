<?php

namespace App\Services\Cargos;

use App\Models\Cargos;

class StoreCargosService
{
    private Cargos $cargos;

    public function __construct(Cargos $cargos)
    {
        $this->cargos = $cargos;
    }

    public function run(array $data)
    {
        return $this->cargos->create($data);
    }
}
