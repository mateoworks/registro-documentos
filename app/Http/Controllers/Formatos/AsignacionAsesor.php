<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class AsignacionAsesor extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $estudianteId)
    {
        $sql = "
        SELECT
            depto.nombre nombre_depto,
            CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            est.numero_control,
            car.nombre AS nombre_carrera,
            proy.nombre AS nombre_proyecto,
            per.nombre AS nombre_periodo,
            emp.nombre AS nombre_empresa,
            CONCAT(depto.nombre_titular, ' ', depto.apellidos_titular) AS jefe_carrera
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN departamentos depto ON car.id = depto.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        LEFT JOIN periodos per ON r.periodo_id = per.id
        LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
        WHERE r.estudiante_id = :idestudiante
        ";
        $resultado = DB::select($sql, ['idestudiante' => $estudianteId]);
        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        } else {
            return;
        }

        $templatePath = public_path('/formatos/TecNM-AC-PO-004-02-Asignacion-de asesor-interno.docx');
        if (file_exists($templatePath)) {
            $templateProcessor = new TemplateProcessor($templatePath);

            $numOficio = $request->query('num_oficio') ?? '';
            if ($request->query('fecha')) {
                $fechaReq = $request->query('fecha');
                $fechaInicio = Carbon::parse($fechaReq);
                $fecha = $fechaInicio->isoFormat('DD [de] MMMM [de] YYYY');
            } else {
                $fecha = "Colocar fecha";
            }

            $templateProcessor->setValue('1', $datosEstudiante->nombre_depto);
            $templateProcessor->setValue('2', $numOficio);
            $templateProcessor->setValue('3', $fecha);
            $templateProcessor->setValue('4', $datosEstudiante->asesor);
            $templateProcessor->setValue('6', $datosEstudiante->nombre_estudiante);
            $templateProcessor->setValue('7', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('8', $datosEstudiante->nombre_proyecto);
            $templateProcessor->setValue('9', $datosEstudiante->nombre_periodo);
            $templateProcessor->setValue('10', $datosEstudiante->nombre_empresa);
            $templateProcessor->setValue('11', strtoupper($datosEstudiante->jefe_carrera));

            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-02-asignacion-asesor-interno-" . $datosEstudiante->numero_control . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        }
    }
}
