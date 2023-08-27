<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrega>
 */
class EntregaFactory extends Factory
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
            'student_id' => function () {
                return Estudiante::factory()->create()->id;
            },
            'documento_id' => function () {
                return Documento::factory()->create()->id;
            },
            'fecha_entrega' => Carbon::now(),
            'estado' => $this->faker->boolean,
        ];
    }
}
