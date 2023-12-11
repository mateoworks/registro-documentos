<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periodo::factory([
            'nombre' => 'Enero - julio 2020',
            'fecha_inicio' => '2020-01-01',
            'fecha_termino' => '2020-07-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Agosto - diciembre 2020',
            'fecha_inicio' => '2020-08-01',
            'fecha_termino' => '2020-12-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Enero - julio 2021',
            'fecha_inicio' => '2021-01-01',
            'fecha_termino' => '2021-07-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Agosto - diciembre 2021',
            'fecha_inicio' => '2021-08-01',
            'fecha_termino' => '2021-12-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Enero - julio 2022',
            'fecha_inicio' => '2022-01-01',
            'fecha_termino' => '2022-07-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Agosto - diciembre 2022',
            'fecha_inicio' => '2022-08-01',
            'fecha_termino' => '2022-12-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Enero - julio 2023',
            'fecha_inicio' => '2023-01-01',
            'fecha_termino' => '2023-07-30',
        ])->create();
        Periodo::factory([
            'nombre' => 'Agosto - diciembre 2023',
            'fecha_inicio' => '2023-08-01',
            'fecha_termino' => '2023-12-30',
            'activo' => '1'
        ])->create();
    }
}
