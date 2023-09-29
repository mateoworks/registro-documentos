<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::factory()->create(['nombre_documento' => 'Solicitud de residencia', 'abrev_nombre' => 'Solicitud residencia']);
        Documento::factory()->create(['nombre_documento' => 'Carta de presentación', 'abrev_nombre' => 'Carta de presentación']);
        Documento::factory()->create(['nombre_documento' => 'Carta de aceptación', 'abrev_nombre' => 'Carta de aceptación']);
        Documento::factory()->create(['nombre_documento' => 'Anteproyecto', 'abrev_nombre' => 'Anteproyecto']);
        Documento::factory()->create(['nombre_documento' => 'Contancia de terminación']);
        Documento::factory()->create(['nombre_documento' => 'Contancia de créditos']);
        Documento::factory()->create(['nombre_documento' => 'Copia de recibo de reincripción']);
        Documento::factory()->create(['nombre_documento' => 'ESP Constancia de aprobación (extraescolares)']);
        Documento::factory()->create(['nombre_documento' => 'MAT Constancia de aprobación (extraescolares)']);
        Documento::factory()->create(['nombre_documento' => 'CIV Constancia de aprobación (extraescolares)']);
        Documento::factory()->create(['nombre_documento' => 'CLUB Constancia de aprobación (extraescolares)']);
        Documento::factory()->create(['nombre_documento' => '1er seguimiento de proyecto del resid']);
        Documento::factory()->create(['nombre_documento' => '2do seguimiento de proyecto del resid']);
        Documento::factory()->create(['nombre_documento' => '3er seguimiento de proyecto del resid']);
        Documento::factory()->create(['nombre_documento' => 'Asesorías 1']);
        Documento::factory()->create(['nombre_documento' => 'Asesorías 2']);
        Documento::factory()->create(['nombre_documento' => 'Asesorías 3']);
        Documento::factory()->create(['nombre_documento' => 'Asesorías 4']);
        Documento::factory()->create(['nombre_documento' => '1er seguimiento y evaluación 1']);
        Documento::factory()->create(['nombre_documento' => '2do seguimiento y evaluación 1']);
        Documento::factory()->create(['nombre_documento' => '3er seguimiento y evaluación 1']);
        Documento::factory()->create(['nombre_documento' => 'Carta de terminación de residencia']);
        Documento::factory()->create(['nombre_documento' => 'Evaluación del reporte final de ...']);
        Documento::factory()->create(['nombre_documento' => 'Solicitud de estudiante para']);
        Documento::factory()->create(['nombre_documento' => '4 empastados de informe técnico de resid. pro. y 4 discos']);
        Documento::factory()->create(['nombre_documento' => 'Base de concertación']);
    }
}
