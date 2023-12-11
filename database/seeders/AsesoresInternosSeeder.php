<?php

namespace Database\Seeders;

use App\Models\AsesorInterno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsesoresInternosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AsesorInterno::factory([
            'nombre' => 'Edwin Manuel',
            'apellidos' => 'Yam Cahuich',
            'email' => 'edwin@ittecomatlan.edu.mx',
            'telefono' => '(275) 987 6543',
            'titulo' => 'Lic. en Sistemas'
        ])->create();
        AsesorInterno::factory([
            'nombre' => 'LeoDan',
            'apellidos' => 'Vazquez Martínez',
            'email' => 'leodan@ittecomatlan.edu.mx',
            'telefono' => '(275) 987 6543',
            'titulo' => 'M.C. en Sistemas'
        ])->create();
        AsesorInterno::factory([
            'nombre' => 'Salvador',
            'apellidos' => 'Vazquez Martínez',
            'email' => 'chava@ittecomatlan.edu.mx',
            'telefono' => '(275) 987 6543',
            'titulo' => 'N.C. en Sistemas'
        ])->create();
        AsesorInterno::factory([
            'nombre' => 'Noemí',
            'apellidos' => 'Bravo Prado',
            'email' => 'noemi@ittecomatlan.edu.mx',
            'telefono' => '(275) 987 6543',
            'titulo' => 'M.C. en Sistemas'
        ])->create();
        AsesorInterno::factory([
            'nombre' => 'Nadia Luz',
            'apellidos' => 'Flores Juárez',
            'email' => 'nadia@ittecomatlan.edu.mx',
            'telefono' => '(275) 987 6543',
            'titulo' => 'Lic. en Sistemas'
        ])->create();
    }
}
