<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\Entrega;
use App\Models\Estudiante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiantes = Estudiante::all();
        $documentos = Documento::all();
        foreach ($estudiantes as $estudiante) {

            $repetirEntregas = rand(1, 3);
            for ($i = 0; $i < $repetirEntregas; $i++) {
                Entrega::factory()->create([
                    'student_id' => $estudiante->id,
                    'documento_id' => $documentos->random()->id,
                ]);
            }

            if ($repetirEntregas === 1) {
                Entrega::factory()->create([
                    'student_id' => $estudiante->id,
                    'documento_id' => $documentos->random()->id,
                ]);
            }
        }
    }
}
