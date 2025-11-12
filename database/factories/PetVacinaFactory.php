<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\Vacina;
use App\Models\PetVacina;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetVacinaFactory extends Factory
{
    protected $model = PetVacina::class;

    public function definition()
    {
        return [
            'pet_id' => Pet::factory(),
            'vacina_id' => Vacina::factory(),
            'data_aplicacao' => $this->faker->date(),
            'data_proxima_dose' => $this->faker->date(),
        ];
    }
}
