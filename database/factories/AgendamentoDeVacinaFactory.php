<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;
use App\Models\Vacina;

class AgendamentoDeVacinaFactory extends Factory
{
    protected $model = \App\Models\AgendamentoDeVacina::class;

    public function definition()
    {
        return [
            'pet_id' => Pet::factory(),
            'vacina_id' => Vacina::factory(),
            'data_agendada' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
