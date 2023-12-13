<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'asesor_externo' => $this->faker->name,
            'asesor_externo_puesto' => $this->faker->jobTitle,
            'nombre_firmara' => $this->faker->name,
            'nombre_firmara_puesto' => $this->faker->jobTitle,
            'empresa_id' => function () {
                return \App\Models\Empresa::inRandomOrder()->first()->id;
            },
        ];
    }
}
