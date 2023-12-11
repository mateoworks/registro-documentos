<?php

namespace Database\Seeders;

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
        Empresa::factory([
            'nombre' => 'Instituto Tecnológico de Tecomatlán - Depto. División Estudios',
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
            'asesor_externo' => 'Bernarndo Torres Hernández',
            'asesor_externo_puesto' => 'Jefe DDEP',
            'nombre_firmara' => 'Bernarndo Torres Hernández',
            'nombre_firmara_puesto' => 'Jefe DDEP',
        ])->create();

        Empresa::factory([
            'nombre' => 'Instituto Tecnológico de Tecomatlán - Depto. Ciencias Básicas',
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
            'asesor_externo' => 'M.C. Noemí Bravo Prado',
            'asesor_externo_puesto' => 'Jefe Ciencias Básicas',
            'nombre_firmara' => 'M.C. Noemí Bravo Prado',
            'nombre_firmara_puesto' => 'Jefe Ciencias Básicas',
        ])->create();

        Empresa::factory([
            'nombre' => 'Instituto Tecnológico de Tecomatlán - Depto. Gestión Tecnológica y Vinculación',
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
            'asesor_externo' => 'Lic. Atzinia Balvuena Bravo',
            'asesor_externo_puesto' => 'Jefe DGTyV',
            'nombre_firmara' => 'Lic. Atzinia Balvuena Bravo',
            'nombre_firmara_puesto' => 'Jefe DGTyV',
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
            'asesor_externo' => 'Lic. Damian Cruz Mateos',
            'asesor_externo_puesto' => 'CFO. de la insitución',
            'nombre_firmara' => 'Lic. Damian Cruz Mateos',
            'nombre_firmara_puesto' => 'CFO. de la insitución',
        ])->create();
    }
}
