<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class InformeSemestral extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $estudianteId)
    {
        $sql = "
        SELECT
            proy.nombre AS nombre_proyecto,
            est.numero_control,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            car.nombre AS nombre_carrera,
            emp.nombre AS nombre_empresa
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
        WHERE est.id = :idestudiante
        ";
        $resultado = DB::select($sql, ['idestudiante' => $estudianteId]);
        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        } else {
            return;
        }
        $templatePath = public_path('/formatos/TecNM-AC-PO-004-06-Informe-semestral-de-residencia-profesional.docx');

        if (file_exists($templatePath)) {
            $templateProcessor = new TemplateProcessor($templatePath);

            $templateProcessor->setValue('2', 'Depto');
            $templateProcessor->setValue('7', $datosEstudiante->nombre_proyecto);
            $templateProcessor->setValue('8', $datosEstudiante->numero_control);
            $templateProcessor->setValue('9', $datosEstudiante->nombre_estudiante);
            $templateProcessor->setValue('10', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('11', $datosEstudiante->nombre_empresa);

            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-06-Informe-semestral-de-residencia-profesional-" . $datosEstudiante->numero_control . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        }
    }
}
