<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => \App\Models\User::factory(),
            'carrera_id' => \App\Models\Carrera::pluck('id')->random(),
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'numero_control' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'domicilio' => $this->faker->streetAddress,
            'email' => $this->faker->unique()->safeEmail,
            'seguridad_social' => $this->faker->word,
            'no_seguridad_social' => null,
            'ciudad' => $this->faker->city,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
