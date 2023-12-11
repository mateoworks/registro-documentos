<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proyecto::factory([
            'carrera_id' => '2',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Desarrollo de Sistema de Gestión de Inventarios para PyMES',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '2',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Implementación de Redes Neuronales para Análisis de Datos Biomédicos',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '2',
            'tipo' => 'Trabajador',
            'nombre' => 'Optimización de Algoritmos de Enrutamiento en Redes de Sensores',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '2',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Creación de Plataforma de E-learning para Capacitación en TI',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '2',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Desarrollo de Aplicación Móvil para Monitoreo de Cultivos Agrícolas',
        ])->create();

        Proyecto::factory([
            'carrera_id' => '3',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Estudio de Mercado para Expansión Internacional de una Empresa',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '3',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Plan Estratégico para Mejora de Procesos en una Cadena de Suministro',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '3',
            'tipo' => 'Trabajador',
            'nombre' => 'Análisis Financiero y Propuesta de Inversión para una Startup',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '3',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Implementación de Estrategias de Marketing Digital en una PyME',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '3',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Diseño de Modelos de Negocio para Emprendimientos Sociales',
        ])->create();

        Proyecto::factory([
            'carrera_id' => '1',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Desarrollo de Sistemas de Riego Inteligente para Cultivos de Hortalizas',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '1',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Estudio de Suelos y Evaluación de Fertilizantes para Mejorar la Producción Agrícola',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '1',
            'tipo' => 'Trabajador',
            'nombre' => 'Investigación y Aplicación de Técnicas de Agricultura de Precisión',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '1',
            'tipo' => 'Banco de Proyectos',
            'nombre' => 'Diseño de Programas de Manejo Integrado de Plagas y Enfermedades en Cultivos',
        ])->create();
        Proyecto::factory([
            'carrera_id' => '1',
            'tipo' => 'Propuesta propia',
            'nombre' => 'Implementación de Prácticas Sostenibles en la Producción Agropecuaria',
        ])->create();
    }
}
