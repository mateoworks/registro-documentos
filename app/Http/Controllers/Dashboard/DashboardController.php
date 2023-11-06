<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function residentes()
    {
        $periodoActivo = Periodo::where('activo', true)->first();
        $residentes = $periodoActivo->estudiantes->count();
        if ($residentes) {
            return response()->json([
                'no_residentes' => $residentes,
            ]);
        } else {
            return response()->json([
                'no_residentes' => 0,
            ]);
        }
    }
    public function estudiantesPorCarrera()
    {
        // Obtener el primer periodo activo
        $periodoActivo = Periodo::where('activo', true)->first();
        $baseURL = config('app.url') . '/storage/';
        // Consulta SQL para obtener el número de estudiantes por carrera y el campo "escudo"
        $results = DB::select('
            SELECT
                c.id AS carrera_id,
                c.nombre AS carrera,
                CASE
                    WHEN c.escudo LIKE "http%" THEN c.escudo
                    ELSE CONCAT(:baseURL, c.escudo)
                END AS escudo,
                c.color AS color,
                COUNT(e.id) AS numero_estudiantes
            FROM carreras AS c
            LEFT JOIN estudiantes AS e ON c.id = e.carrera_id
            WHERE e.id IN (
                SELECT estudiante_id FROM empresa_estudiante WHERE periodo_id = :periodo_id
            )
            GROUP BY c.id, c.nombre, c.escudo
        ', ['periodo_id' => $periodoActivo->id, 'baseURL' => $baseURL]);
        if ($results) {
            return response()->json($results);
        } else {
            return response()->json([]);
        }
    }
}
