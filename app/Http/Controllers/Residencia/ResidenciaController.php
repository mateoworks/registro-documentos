<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodoResource;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResidenciaController extends Controller
{
    public function periodoActivo()
    {
        $periodo = Periodo::where('activo', true)->first();
        if ($periodo) {
            return PeriodoResource::make($periodo);
        } else {
            return null;
        }
    }

    public function asignarResidencia(Request $request, Estudiante $estudiante)
    {
        if (!$request->periodo_id)
            $periodo = Periodo::where('activo', true)->first();
        else
            $periodo = Periodo::findOrFail($request->periodo_id);

        $existingAssignment = $estudiante->empresas()
            ->where('periodo_id', $periodo->id)
            ->where('actividad', 'Residencia profesional')
            ->count();

        if ($existingAssignment > 0) {
            return response()->json(['message' => 'El estudiante ya tiene una asignación de residencia en este período activo'], 422);
        }

        $estudiante->empresas()->attach($request->empresa_id, [
            'proyecto' => $request->proyecto,
            'periodo_id' => $periodo->id,
            'actividad' => 'Residencia profesional',
        ]);

        return response()->json(['message' => 'La asignación de residencia fue exitosa'], 200);
    }

    public function ver($residente)
    {
        $estudianteId = $residente;
        $urlApp = config('app.url') . '/storage/';
        $resultado = DB::select("
            SELECT
                estudiantes.*,
                estudiantes.nombre AS nombre_estudiante,
                estudiantes.telefono AS telefono_estudiante,
                estudiantes.domicilio AS domicilio_estudiante,
                estudiantes.ciudad AS ciudad_estudiante,
                estudiantes.id AS id_estudiante,
                carreras.nombre AS nombre_carrera,
                carreras.color AS color_carrera,
                carreras.escudo AS escudo_carrera,
                periodos.nombre AS nombre_periodo,
                periodos.id AS id_periodo,
                IF(users.url_foto IS NULL OR users.url_foto = '', NULL, CONCAT('$urlApp', users.url_foto)) AS url_foto,
                empresas.*,
                empresas.id AS id_empresa,
                empresa_estudiante.proyecto
            FROM estudiantes
            JOIN carreras ON estudiantes.carrera_id = carreras.id
            JOIN empresa_estudiante ON estudiantes.id = empresa_estudiante.estudiante_id
            JOIN empresas ON empresa_estudiante.empresa_id = empresas.id
            JOIN periodos ON empresa_estudiante.periodo_id = periodos.id
            JOIN users ON estudiantes.user_id = users.id
            WHERE estudiantes.id = :estudiante_id
        ", ['estudiante_id' => $estudianteId]);

        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        }
        return response()->json($datosEstudiante, 200);
    }

    public function residentes()
    {
        $urlApp = config('app.url') . '/storage/';
        $sql = "
            SELECT
                e.id AS estudiante_id,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo,
                IF(u.url_foto IS NULL OR u.url_foto = '', NULL, CONCAT('$urlApp', u.url_foto)) AS url_foto,
                CONCAT(LEFT(e.nombre, 1), LEFT(e.apellidos, 1)) AS iniciales_nombre_apellido,
                c.abrev AS nombre_carrera,
                c.color AS color_carrera,
                emp.nombre AS nombre_empresa,
                emp.telefono AS telefono_empresa,
                e.telefono AS telefono_estudiante,
                e.numero_control AS numero_control_estudiante,
                ee.proyecto AS proyecto
            FROM empresa_estudiante AS ee
            INNER JOIN estudiantes AS e ON ee.estudiante_id = e.id
            INNER JOIN users AS u ON e.user_id = u.id
            INNER JOIN carreras AS c ON e.carrera_id = c.id
            INNER JOIN empresas AS emp ON ee.empresa_id = emp.id
            INNER JOIN periodos AS p ON ee.periodo_id = p.id
            WHERE p.activo = 1
            AND e.deleted_at IS NULL;
        ";

        $residentes = DB::select($sql);
        return response()->json($residentes);
    }

    public function cancelarResidencia($estudiante)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $estudiante->empresas()->detach();
        return response()->json(['message' => 'Se canceló la residencia'], 200);
    }

    public function estudiantesSinResidencia()
    {
        $sql = "SELECT estudiantes.id, CONCAT(estudiantes.nombre, ' ', estudiantes.apellidos) AS nombre
        FROM estudiantes
        LEFT JOIN empresa_estudiante ON estudiantes.id = empresa_estudiante.estudiante_id
        WHERE empresa_estudiante.estudiante_id IS NULL
        AND estudiantes.deleted_at IS NULL";
        $estudiantesSinEmpresa = DB::select($sql);
        return response()->json($estudiantesSinEmpresa, 200);
    }

    public function actualizarResidencia(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required',
            'empresa_id' => 'required',
            'proyecto' => 'required',
            'periodo_id' => 'required',
        ]);
        $estudiante = Estudiante::findOrFail($request->estudiante_id);
        $estudiante->empresas()->sync([$request->empresa_id => [
            'proyecto' => $request->proyecto,
            'periodo_id' => $request->periodo_id,
            'actividad' => 'Residencia profesional',
        ]]);
    }

    public function entregasPorResidente(Request $request)
    {
        $estudianteId = $request->id;
        $estudiante = Estudiante::findOrFail($estudianteId)->get();
        $urlApp = config('app.url') . '/storage/';
        $sql = "
        SELECT
            e.id AS Id,
            d.nombre_documento AS NombreDocumento,
            e.fecha_entrega AS FechaEntrega,
            d.fecha_limite AS FechaLimite,
            CONCAT(:url_app, e.url_documento) AS URLDocumento,
            SUBSTRING_INDEX(e.url_documento, '.', -1) AS ExtensionDocumento,
            CASE
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) IN ('doc', 'docx') THEN 'description'
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) = 'pdf' THEN 'picture_as_pdf'
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) IS NULL THEN 'clear'
                ELSE 'article'
            END AS Icono
        FROM entregas AS e
        JOIN estudiantes AS es ON e.estudiante_id = es.id
        JOIN documentos AS d ON e.documento_id = d.id
        WHERE e.estudiante_id = :student_id
        ORDER BY e.fecha_entrega DESC, e.created_at DESC;
        ";

        $datosResidente = DB::select($sql, ['student_id' => $estudianteId, 'url_app' => $urlApp]);
        return response()->json($datosResidente);
    }

    public function empresas(Request $request)
    {
        $empresas = Empresa::where('nombre', 'LIKE', '%' . $request->nombre . '%')
            ->select('id', 'nombre')
            ->get();
        return $empresas;
    }
}
