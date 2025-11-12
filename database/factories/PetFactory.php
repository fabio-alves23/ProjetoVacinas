<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->firstName,
            'species' => $this->faker->randomElement(['Cachorro', 'Gato']),
            'breed' => $this->faker->word,
            'birthdate' => $this->faker->date(),
        ];
    }
}
