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

        $busqueda = $request->input('busqueda');

        $results = DB::select('
            SELECT
                e.id AS estudiante_id,
                CONCAT(e.nombre, " ", e.apellidos) AS nombre_completo
            FROM estudiantes AS e
            WHERE e.id IN (
                SELECT estudiante_id FROM empresa_estudiante WHERE periodo_id = :periodo_id
            )
            AND CONCAT(e.nombre, " ", e.apellidos) LIKE :busqueda
        ', ['periodo_id' => $periodoActivo->id, 'busqueda' => "%$busqueda%"]);

        return response()->json($results);
    }
}
