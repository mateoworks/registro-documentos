<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiantes = [
            [
                'nombre' => 'Rocel',
                'apellidos' => 'Ángel Isidro',
                'numero_control' => '19970101',
            ],
            [
                'nombre' => 'Juana Andres',
                'apellidos' => 'Dario Andres',
                'numero_control' => '19970102',
            ],
            [
                'nombre' => 'Jesús Tiacaelel',
                'apellidos' => 'Flores De La Cruz',
                'numero_control' => '19970103',
            ],
            [
                'nombre' => 'Pavel',
                'apellidos' => 'Efraín',
                'numero_control' => '19970104',
            ],
            [
                'nombre' => 'Lilia Minerva',
                'apellidos' => 'García Nuñez',
                'numero_control' => '19970105',
            ],
            [
                'nombre' => 'Rafael',
                'apellidos' => 'Gaspar Aguilar',
                'numero_control' => '19970106',
            ],
            [
                'nombre' => 'Naila Azucena',
                'apellidos' => 'Gómez Vidals',
                'numero_control' => '19970107',
            ],
            [
                'nombre' => 'Irving',
                'apellidos' => 'Hérnandez Villa',
                'numero_control' => '19970108',
            ],
            [
                'nombre' => 'Israel',
                'apellidos' => 'Larios Moreno',
                'numero_control' => '19970109',
            ],
            [
                'nombre' => 'Azucena',
                'apellidos' => 'López Jiménez',
                'numero_control' => '19970110',
            ],
            [
                'nombre' => 'Aldair',
                'apellidos' => 'López Ortíz',
                'numero_control' => '19970111',
            ],
            [
                'nombre' => 'José Francisco',
                'apellidos' => 'Mansilla Huixtaba',
                'numero_control' => '19970112',
            ],
            [
                'nombre' => 'Adín',
                'apellidos' => 'Margarito Mateos',
                'numero_control' => '19970113',
            ],
            [
                'nombre' => 'Verónica',
                'apellidos' => 'Mendoza Galeana',
                'numero_control' => '19970114',
            ],
            [
                'nombre' => 'Fidelia',
                'apellidos' => 'Ortega Vivar',
                'numero_control' => '19970115',
            ],
        ];

        foreach ($estudiantes as $estudiante) {
            $nombre = $estudiante['nombre'];
            $apellidos = $estudiante['apellidos'];
            $numero_control = $estudiante['numero_control'];

            Estudiante::factory([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'numero_control' => $numero_control
            ])->create();
        }
    }
}
