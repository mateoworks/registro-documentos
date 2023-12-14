<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itt = Empresa::factory([
            'nombre' => 'Instituto Tecnológico de Tecomatlán',
            'giro' => 'Público',
            'rfc' => 'SEP2109057',
            'domicilio' => 'Carretera Palomas – Tlapa en el km 19.5',
            'colonia' => 'Unidad habitacional',
            'cp' => '74870',
            'ciudad' => 'Tecomatlán, Puebla',
            'telefono' => '01(275)4412042',
            'mision' => 'Ofertar educación de nivel superior que forme integralmente profesionistas con equidad, calidad, competencia técnica, actitud justa, emprendedora, formación social y humanista que les permita incorporarse al sector productivo, logrando un incremento en la producción y productividad y conservando la armonía hombre-naturaleza.',
            'titular' => 'M.C. Gabriel López Salvador',
            'titular_puesto' => 'CEO de la institución',
        ])->create();

        Area::factory([
            'nombre' => 'Departamento de Gestión Tecnológica y Vinculación',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Servicios Escolares',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Recursos Humanos',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Finanzas y Administración',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Planeación y Evaluación',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Departamento de Mantenimiento',
            'empresa_id' => $itt->id,
        ])->create();
        Area::factory([
            'nombre' => 'Departamento de Tecnologías de la Información',
            'empresa_id' => $itt->id,
        ])->create();

        Empresa::factory([
            'nombre' => 'Centro de Bachillerato Tecnológico Agropecuario Número 110 (CBTA 110)',
            'giro' => 'Público',
            'rfc' => '21DTA0110B',
            'domicilio' => 'Carretera Palomas – Tlapa en el km 19.5',
            'colonia' => 'Unidad habitacional',
            'cp' => '74870',
            'ciudad' => 'Tecomatlán, Puebla',
            'telefono' => '275 441 2224',
            'mision' => 'Ofrecer una formación integral, social, humanista y tecnológica centradas en la persona, que consolide el conocimiento hacia el sector rural, fortalezca la pertinencia, fomente la mentalidad emprendedora y de liderazgo.',
            'titular' => 'M.C. Adelina Martínez Martínez',
            'titular_puesto' => 'CEO de la institución',
        ])->create();
    }
}
