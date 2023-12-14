<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
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
            'nombre' => $this->faker->company,
            'giro' => $this->faker->word,
            'rfc' => $this->faker->regexify('[A-Z0-9]{13}'),
            'domicilio' => $this->faker->streetAddress,
            'colonia' => $this->faker->word,
            'cp' => $this->faker->postcode,
            'ciudad' => $this->faker->city,
            'telefono' => $this->faker->phoneNumber,
            'mision' => $this->faker->paragraph,
            'titular' => $this->faker->name,
            'titular_puesto' => $this->faker->jobTitle,
        ];
    }
}
