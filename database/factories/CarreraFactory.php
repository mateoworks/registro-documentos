<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departamento_id' => function () {
                return \App\Models\Departamento::factory()->create()->id;
            },
            'nombre' => $this->faker->word,
            'escudo' => $this->faker->imageUrl(200, 200, 'cats'), // Cambia 'cats' por el tipo de imagen que desees
            'clave' => $this->faker->unique()->regexify('[A-Z]{3}'),
        ];
    }
}
