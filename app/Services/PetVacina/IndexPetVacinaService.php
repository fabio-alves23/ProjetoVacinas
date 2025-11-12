<?php

namespace App\Services\PetVacina;

use App\Models\PetVacina;

class IndexPetVacinaService
{
    public function run(int $petId, int $perPage = 10)
    {
        return PetVacina::with('vacina:id,nome')
            ->where('pet_id', $petId)
            ->paginate($perPage);
    }
}
