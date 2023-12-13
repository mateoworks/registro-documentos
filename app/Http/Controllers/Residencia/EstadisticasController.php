<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function getEstudiantesPorPeriodo(Request $request)
    {
        $data = DB::select("
            SELECT p.nombre AS periodo, c.nombre AS carrera, COUNT(e.id) AS cantidad_estudiantes
            FROM periodos p
            JOIN residencias ee ON p.id = ee.periodo_id
            JOIN estudiantes e ON ee.estudiante_id = e.id
            JOIN carreras c ON e.carrera_id = c.id
            GROUP BY p.nombre, p.fecha_inicio, c.nombre
            ORDER BY p.fecha_inicio ASC
        ");

        return response()->json($data);
    }
}
