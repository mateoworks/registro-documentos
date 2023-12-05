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
        if ($periodoActivo) {
            $residentes = $periodoActivo->residencias->count();
            if ($residentes) {
                return response()->json([
                    'no_residentes' => $residentes,
                ]);
            } else {
                return response()->json([
                    'no_residentes' => 0,
                ]);
            }
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
        if ($periodoActivo) {
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
                FROM carreras c
                LEFT JOIN estudiantes e ON c.id = e.carrera_id
                LEFT JOIN residencias r ON e.id = r.estudiante_id
                LEFT JOIN periodos p ON r.periodo_id = p.id
                WHERE p.activo = true
                GROUP BY carrera_id


            ', ['baseURL' => $baseURL]);
            if ($results) {
                return response()->json($results);
            } else {
                return response()->json([]);
            }
        } else {
            return response()->json([]);
        }
    }
}
