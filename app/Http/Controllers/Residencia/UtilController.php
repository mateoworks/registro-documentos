<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilController extends Controller
{
    public function autocompletarEstudiante(Request $request)
    {
        $periodoActivo = Periodo::where('activo', true)->first();

        $query = "
            SELECT e.id AS estudiante_id,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo
            FROM estudiantes e
            JOIN residencias r ON e.id = r.estudiante_id
            JOIN periodos p ON r.periodo_id = p.id
            WHERE p.activo = true
        ";
        if ($periodoActivo) {
            $results = DB::select($query);
            return response()->json($results);
        }
        return response()->json([]);
    }

    public function documentosPendientes(Request $request)
    {
        $studentId = $request->id;
        $sql = "
        SELECT
            d.id AS id,
            d.nombre_documento AS nombre
        FROM documentos AS d
        LEFT JOIN entregas AS e
            ON d.id = e.documento_id
            AND e.estudiante_id = :student_id
        WHERE e.id IS NULL
        ORDER BY d.id;
        ";

        $documentosNoEntregados = DB::select($sql, ['student_id' => $studentId]);
        return response()->json($documentosNoEntregados);
    }
}
