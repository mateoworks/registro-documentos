<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class FormatoController extends Controller
{
    public function formatoCartaPresentacion($estudianteId)
    {
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
                periodos.nombre AS nombre_periodo,
                periodos.id AS id_periodo,
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
            $templateProcessor->setValue('5', $datosEstudiante->nombre);
            $templateProcessor->setValue('7', $datosEstudiante->nombre_estudiante . " " . $datosEstudiante->apellidos);
            $templateProcessor->setValue('8', $datosEstudiante->numero_control);
            $templateProcessor->setValue('9', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('11', $datosEstudiante->seguridad_social);
            $templateProcessor->setValue('12', $datosEstudiante->no_seguridad_social);
            $templateProcessor->setValue('3', $datosEstudiante->titular);

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
            $nombreDoc = "Carta-presentacion-" . $datosEstudiante->numero_control . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        } else {
            // La plantilla no se encuentra en la ruta especificada
            return "La plantilla no se encuentra en la ubicación especificada.";
        }
    }
}
