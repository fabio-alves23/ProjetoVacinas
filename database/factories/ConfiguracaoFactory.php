<?php

namespace Database\Factories;

use App\Models\Configuracao;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfiguracaoFactory extends Factory
{
    protected $model = Configuracao::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->word(),
            'valor' => $this->faker->boolean(), // gera true ou false aleatório
        ];
    }
}
