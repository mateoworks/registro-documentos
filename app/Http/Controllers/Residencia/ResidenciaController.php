<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidenteRequest;
use App\Http\Resources\PeriodoResource;
use App\Models\Documento;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\Residencia;
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

    public function asignarResidencia(ResidenteRequest $request, Estudiante $estudiante)
    {
        $data = $request->all();
        if (!$request->periodo_id)
            $periodo = Periodo::where('activo', true)->first();
        else {
            $periodo = Periodo::findOrFail($request->periodo_id);
        }
        $data['periodo_id'] = $periodo->id;

        Residencia::create($data);

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
                areas.id AS area_id,
                areas.asesor_externo,
                areas.asesor_externo_puesto,
                areas.nombre_firmara,
                areas.nombre_firmara_puesto,
                proyectos.nombre AS proyecto,
                proyectos.tipo AS tipo_proyecto,
                proyectos.id AS proyecto_id,
                asesor_interno.id AS asesor_id,
                CONCAT(asesor_interno.nombre, ' ', asesor_interno.apellidos) AS nombre_asesor
            FROM estudiantes
            JOIN carreras ON estudiantes.carrera_id = carreras.id
            JOIN residencias ON estudiantes.id = residencias.estudiante_id
            JOIN areas ON residencias.area_id = areas.id
            JOIN empresas ON areas.empresa_id = empresas.id
            JOIN periodos ON residencias.periodo_id = periodos.id
            JOIN users ON estudiantes.user_id = users.id
            LEFT JOIN proyectos ON residencias.proyecto_id = proyectos.id
            LEFT JOIN asesor_interno ON residencias.asesor_interno_id = asesor_interno.id
            WHERE estudiantes.id = :estudiante_id
        ", ['estudiante_id' => $estudianteId]);
        $datosEstudiante = [];
        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        }
        return response()->json($datosEstudiante, 200);
    }

    public function residentes(Request $request)
    {
        //Total de documentos
        $totalDocumentos = Documento::count();
        $urlApp = config('app.url') . '/storage/';
        $sql = "
            SELECT e.id AS id_estudiante,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo,
                IF(u.url_foto IS NULL OR u.url_foto = '', NULL, CONCAT('$urlApp', u.url_foto)) AS url_foto,
                CONCAT(LEFT(e.nombre, 1), LEFT(e.apellidos, 1)) AS iniciales_nombre_apellido,
                c.nombre AS nombre_carrera,
                c.abrev AS abrev_carrera,
                c.color AS color_carrera,
                em.nombre AS nombre_empresa,
                em.telefono AS telefono_empresa,
                e.telefono AS telefono_estudiante,
                e.numero_control AS numero_control_estudiante,
                p.nombre AS proyecto,
                p.tipo AS tipo_proyecto,
                CONCAT(ai.nombre, ' ', ai.apellidos) AS nombre_asesor,
                :totalDocumentos AS total_documentos,
                (
                    SELECT COUNT(*)
                    FROM entregas AS ent
                    WHERE ent.estudiante_id = e.id
                ) AS documentos_entregados
            FROM estudiantes e
            LEFT JOIN users u ON e.user_id = u.id
            LEFT JOIN carreras c ON e.carrera_id = c.id
            LEFT JOIN residencias r ON e.id = r.estudiante_id
            LEFT JOIN areas a ON r.area_id = a.id
            LEFT JOIN empresas em ON a.empresa_id = em.id
            LEFT JOIN proyectos p ON r.proyecto_id = p.id
            LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
            LEFT JOIN periodos pe ON r.periodo_id = pe.id
            WHERE e.deleted_at IS NULL AND pe.activo = true
        ";
        $residentes = DB::select($sql, ['totalDocumentos' => $totalDocumentos]);

        return response()->json($residentes);
    }

    public function cancelarResidencia($estudiante)
    {
        $residencia = Residencia::where('estudiante_id', $estudiante)->first();
        $residencia->delete();
        return response()->json(['message' => 'Se canceló la residencia'], 200);
    }

    public function estudiantesSinResidencia()
    {
        $sql = "SELECT estudiantes.id,
            CONCAT(estudiantes.nombre, ' ', estudiantes.apellidos, ' | ', estudiantes.numero_control) AS nombre
        FROM estudiantes
        LEFT JOIN residencias ON estudiantes.id = residencias.estudiante_id
        WHERE residencias.estudiante_id IS NULL";
        $estudiantesSinEmpresa = DB::select($sql);
        return response()->json($estudiantesSinEmpresa, 200);
    }

    public function actualizarResidencia(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required',
            'area_id' => 'required',
            'proyecto_id' => 'nullable',
            'periodo_id' => 'required',
            'asesor_interno_id' => 'nullable',
        ]);
        $residencia = Residencia::where('estudiante_id', $request->estudiante_id)->first();
        $residencia->update($request->all());
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
