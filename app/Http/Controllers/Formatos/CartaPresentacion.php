<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class CartaPresentacion extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $estudianteId)
    {
        $resultado = DB::select("
        SELECT
            emp.titular,
            emp.titular_puesto,
            emp.nombre AS nombre_empresa,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            est.numero_control,
            est.seguridad_social,
            est.no_seguridad_social,
            car.nombre AS nombre_carrera,
            proy.nombre AS nombre_proyecto
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN departamentos depto ON car.id = depto.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        LEFT JOIN periodos per ON r.periodo_id = per.id
        WHERE r.estudiante_id = :estudiante_id
        ", ['estudiante_id' => $estudianteId]);

        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        }

        $templatePath = public_path('/formatos/TecNM-AC-PO-004-03-Carta-de-presentacion-y-agradecimiento.docx');
        if (file_exists($templatePath)) {
            // Cargar la plantilla
            $templateProcessor = new TemplateProcessor($templatePath);

            // Reemplazar los marcadores en la plantilla con los datos
            $fechaActual = Carbon::now();
            $fechaFormateada = $fechaActual->isoFormat('DD-MMMM-YYYY');
            $templateProcessor->setValue('2', $fechaFormateada);
            $templateProcessor->setValue('3', $datosEstudiante->titular);
            $templateProcessor->setValue('4', $datosEstudiante->titular_puesto);
            $templateProcessor->setValue('5', $datosEstudiante->nombre_empresa);
            $templateProcessor->setValue('7', $datosEstudiante->nombre_estudiante);
            $templateProcessor->setValue('8', $datosEstudiante->numero_control);
            $templateProcessor->setValue('9', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('10', $datosEstudiante->nombre_proyecto);
            $templateProcessor->setValue('11', $datosEstudiante->seguridad_social);
            $templateProcessor->setValue('12', $datosEstudiante->no_seguridad_social);

            // Guardar el documento generado en un directorio temporal
            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-03-Carta-presentacion-" . $datosEstudiante->numero_control . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        } else {
            // La plantilla no se encuentra en la ruta especificada
            return "La plantilla no se encuentra en la ubicación especificada.";
        }
    }
}
