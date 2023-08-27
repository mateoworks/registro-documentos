<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Periodo>
 */
class PeriodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $fechaTermino = $this->faker->dateTimeBetween($fechaInicio, $fechaInicio->format('Y-m-d') . ' +1 month');

        return [
            'nombre' => $this->faker->word,
            'fecha_inicio' => $fechaInicio,
            'fecha_termino' => $fechaTermino,
        ];
    }
}
