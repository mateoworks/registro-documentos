<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\AsesorInterno;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\Proyecto;
use App\Models\Residencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiantes = Estudiante::pluck('id')->toArray();
        $areas = Area::pluck('id')->toArray();
        $proyectos = Proyecto::pluck('id')->toArray();
        $asesores = AsesorInterno::pluck('id')->toArray();

        $faker = \Faker\Factory::create();
        $numRegistros = 10;

        $numRegistros = 10;

        $estudiantesParaAsignar = array_slice($estudiantes, 0, $numRegistros);
        foreach ($estudiantesParaAsignar as $estudianteID) {
            Residencia::create([
                'estudiante_id' => $estudianteID,
                'area_id' => $faker->randomElement($areas),
                'periodo_id' => 8,
                'asesor_interno_id' => $faker->randomElement($asesores),
                'proyecto_id' => $faker->randomElement($proyectos),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
