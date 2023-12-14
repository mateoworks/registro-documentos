<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstudianteResource;
use App\Models\Entrega;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userAuth = Auth::user();
        $user = User::where('id', $userAuth->id)->first();
        /* if (!$user->hasRoles('estudiante')) {
            return 'Error';
        } */
        $id = $userAuth->id;
        //$estudiante = $user->estudiante;

        $estudiante = Estudiante::where('user_id', $id)->first();
        $estudiante->load('carrera');

        $periodos = $estudiante->periodos;
        $periodos->load('empresas');
        $entregas = Entrega::where('estudiante_id', $estudiante->id)->get();
        //$documentos = $entregas->documentos;
        return response()->json([
            'user' => $user,
            'estudiante' => $estudiante,
            'periodos' => $periodos,
            'entregas' => $entregas,
        ]);
    }
    public function estudiante()
    {
        $user = auth()->user();
        if ($user->estudiante) {
            $estudiante = $user->estudiante;
            $estudiante->load('carrera');
            return EstudianteResource::make($estudiante);
        } else {
            return response()->json(['message' => 'El usuario no es un estudiante']);
        }
    }
    public function carreraUser()
    {
        $user = auth()->user();

        if ($user->estudiante) {
            $carrera = $user->estudiante->carrera;
            if ($carrera) {
                return response()->json($carrera);
            } else {
                return response()->json(['message' => 'El estudiante no tiene una carrera asignada'], 404);
            }
        } else {
            return response()->json(['message' => 'El usuario no es un estudiante'], 404);
        }
    }

    public function documentosEntregar()
    {

        $urlApp = config('app.url') . '/storage/';

        $sql = "
        SELECT
            d.id AS id,
            d.nombre_documento AS nombre_documento,
            d.fecha_limite AS fecha_limite,
            CASE
                WHEN d.url_formato IS NULL OR d.url_formato = '' THEN NULL
                ELSE CONCAT(:url_app, d.url_formato)
            END AS url_formato,
            IFNULL(d.url_formato, NULL) AS extencion_documento,
            CASE
                WHEN SUBSTRING_INDEX(d.url_formato, '.', -1) IN ('doc', 'docx') THEN 'description'
                WHEN SUBSTRING_INDEX(d.url_formato, '.', -1) = 'pdf' THEN 'picture_as_pdf'
                WHEN SUBSTRING_INDEX(d.url_formato, '.', -1) IS NULL THEN 'clear'
                ELSE 'article'
            END AS icono
        FROM documentos AS d
        ORDER BY d.fecha_limite;
        ";

        $documentos = DB::select($sql, ['url_app' => $urlApp]);

        return response()->json($documentos);
    }

    public function entregasPorEstudiante()
    {
        $user = auth()->user();
        if (!$user->estudiante) {
            return response()->json(["message" => "Usted no es un residente"]);
        }
        $estudiante = $user->estudiante;
        $urlApp = config('app.url') . '/storage/';
        $sql = "
        SELECT
            e.id AS id,
            d.nombre_documento AS nombre_documento,
            e.fecha_entrega AS fecha_entrega,
            d.fecha_limite AS fecha_limite,
            CASE
                WHEN e.url_documento IS NULL OR e.url_documento = '' THEN NULL
                ELSE CONCAT(:url_app, e.url_documento)
            END AS url_formato,
            SUBSTRING_INDEX(e.url_documento, '.', -1) AS extencion_documento,
            CASE
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) IN ('doc', 'docx') THEN 'description'
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) = 'pdf' THEN 'picture_as_pdf'
                WHEN SUBSTRING_INDEX(e.url_documento, '.', -1) IS NULL THEN 'clear'
                ELSE 'article'
            END AS icono
        FROM entregas AS e
        JOIN estudiantes AS es ON e.estudiante_id = es.id
        JOIN documentos AS d ON e.documento_id = d.id
        WHERE e.estudiante_id = :student_id
        ORDER BY e.fecha_entrega DESC, e.created_at DESC;
        ";

        $datosResidente = DB::select($sql, ['student_id' => $estudiante->id, 'url_app' => $urlApp]);
        return response()->json($datosResidente);
    }

    public function datosResidencia()
    {
        $user = auth()->user();
        if (!$user->estudiante) {
            return response()->json(["message" => "Usted no es un residente"]);
        }
        $estudiante = $user->estudiante;
        $result = DB::select(
            "
            SELECT
                e.id AS estudiante_id,
                pe.id AS periodo_id,
                pe.nombre AS nombre_periodo,
                em.id AS empresa_id,
                CONCAT(em.nombre, ' - ', a.nombre) AS nombre_empresa,
                em.rfc,
                em.domicilio,
                em.colonia,
                em.cp,
                em.ciudad,
                em.telefono,
                em.titular,
                em.titular_puesto,
                pr.nombre AS proyecto,
                CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor_inter,
                ai.email AS email_asesor,
                ai.telefono AS telefono_asesor
            FROM estudiantes e
            INNER JOIN residencias r ON e.id = r.estudiante_id
            INNER JOIN areas a ON r.area_id = a.id
            INNER JOIN empresas em ON a.empresa_id = em.id
            INNER JOIN periodos pe ON r.periodo_id = pe.id
            LEFT JOIN proyectos pr ON r.proyecto_id = pr.id
            LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
            WHERE e.id = ?
            LIMIT 1",
            [$estudiante->id]
        );
        return response()->json($result);
    }
}
