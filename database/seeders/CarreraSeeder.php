<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Agronomía',
            'departamento_id' => 1,
            'color' => '#008000',
            'abrev' => 'IA',
            'escudo' => 'escudo/ia.png',
        ]);

        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Sistemas Computacionales',
            'departamento_id' => 2,
            'color' => '#3b83bd',
            'abrev' => 'ISC',
            'escudo' => 'escudo/isc.png',
        ]);

        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Gestión Empresarial',
            'departamento_id' => 3,
            'color' => '#FFC700',
            'abrev' => 'IGE',
            'escudo' => 'escudo/ige.png',
        ]);
    }
}
