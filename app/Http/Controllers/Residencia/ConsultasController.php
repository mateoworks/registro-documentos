<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    public function residentesPorCarrera(Request $request, $carreraId)
    {
        $periodoId = $request->query('periodoId');

        if (!$periodoId) {
            $periodo = Periodo::where('activo', 1)->first();
            $periodoId = $periodo->id;
        }
        //Total de documentos
        $totalDocumentos = Documento::count();
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
                pr.nombre AS proyecto,
                pr.tipo AS tipo_proyecto,
                :totalDocumentos AS total_documentos,
                (
                    SELECT COUNT(*)
                    FROM entregas AS ent
                    WHERE ent.estudiante_id = e.id
                ) AS documentos_entregados,
                CONCAT(ai.nombre, ' ', ai.apellidos) AS nombre_asesor
            FROM residencias AS ee
            INNER JOIN estudiantes AS e ON ee.estudiante_id = e.id
            INNER JOIN users AS u ON e.user_id = u.id
            INNER JOIN carreras AS c ON e.carrera_id = c.id
            INNER JOIN areas AS a ON ee.area_id = a.id
            INNER JOIN empresas AS emp ON a.empresa_id = emp.id
            INNER JOIN periodos AS p ON ee.periodo_id = p.id
            LEFT JOIN proyectos AS pr ON ee.proyecto_id = pr.id
            LEFT JOIN asesor_interno ai ON ee.asesor_interno_id = ai.id
            WHERE p.id = :periodoId AND c.id = :carreraId
            AND e.deleted_at IS NULL
            ;
        ";
        $residentes = DB::select($sql, [
            'carreraId' => $carreraId,
            'periodoId' => $periodoId,
            'totalDocumentos' => $totalDocumentos
        ]);
        /*         foreach ($residentes as $residente) {
            if (!empty($residente->url_foto)) {
                $image = \Image::make($residente->url_foto);

                $image->resize(80, 80);

                $thumbnailPath = storage_path("app/public/perfil/thumbnails/{$residente->estudiante_id}.jpg");
                $image->save($thumbnailPath);

                $residente->url_foto = $urlApp . "perfil/thumbnails/" . $residente->estudiante_id . ".jpg";
            }
        } */
        return response()->json($residentes);
    }

    public function documentosPendientesPorEntregar($estudiante)
    {
        $estudianteId = $estudiante; // Reemplaza esto con el ID del estudiante específico

        $result = DB::select("
            SELECT
                d.id AS documento_id,
                d.nombre_documento,
                d.abrev_nombre,
                d.fecha_limite,
                d.url_formato,
                d.created_at,
                e.id AS entrega_id,
                e.url_documento AS documento_entregado,
                CASE
                    WHEN d.fecha_limite IS NULL THEN 0
                    WHEN d.fecha_limite < DATE(NOW()) THEN 1
                    ELSE 0
                END AS fecha_limite_vencida
            FROM documentos AS d
            LEFT JOIN entregas AS e ON d.id = e.documento_id AND e.estudiante_id = ?
            WHERE e.id IS NULL
            ORDER BY d.fecha_limite ASC
        ", [$estudianteId]);

        return response()->json($result);
    }
}
