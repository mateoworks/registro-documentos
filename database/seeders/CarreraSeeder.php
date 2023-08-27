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
        // Departamento de Ingenierías
        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Agronomía',
            'departamento_id' => 1, // Ajusta el ID del Departamento de Ingenierías
        ]);

        // Departamento de Ciencias Básicas
        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Sistemas Computacionales',
            'departamento_id' => 2, // Ajusta el ID del Departamento de Ciencias Básicas
        ]);

        // Departamento de Gestión Empresarial
        Carrera::factory()->create([
            'nombre' => 'Ingeniería en Gestión Empresarial',
            'departamento_id' => 3, // Ajusta el ID del Departamento de Gestión Empresarial
        ]);
    }
}
