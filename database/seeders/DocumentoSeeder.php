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
        Documento::factory()->create(['nombre_documento' => 'Solicitud de residencia']);
        Documento::factory()->create(['nombre_documento' => 'Carta de presentación']);
        Documento::factory()->create(['nombre_documento' => 'Carta de acpetación']);
        Documento::factory()->create(['nombre_documento' => 'Anteproyecto']);
        Documento::factory()->create(['nombre_documento' => 'Contancia de terminación']);
        Documento::factory()->create(['nombre_documento' => 'Contancia de créditos']);
        Documento::factory()->create(['nombre_documento' => 'Copia de recibo de reincripción']);
    }
}
