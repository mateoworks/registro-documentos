<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use App\Models\Residencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class SolicitudResidencia extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $estudianteId)
    {
        $sql = "
        SELECT
            CONCAT(depto.nombre_titular, ' ', depto.apellidos_titular) AS jefe_carrera,
            car.nombre AS nombre_carrera,
            proy.nombre AS nombre_proyecto,
            proy.tipo AS tipo_proyecto,
            per.fecha_inicio,
            per.nombre AS periodo_proyectado,
            per.id AS periodo_id,
            emp.nombre AS nombre_empresa,
            emp.giro AS giro,
            emp.rfc AS rfc,
            emp.domicilio AS domicilio_empresa,
            emp.colonia AS colonia_empresa,
            emp.cp AS cp_empresa,
            emp.ciudad AS ciudad_empresa,
            emp.telefono AS telefono_empresa,
            emp.mision AS mision_empresa,
            emp.titular AS nombre_titular,
            emp.titular_puesto,
            a.asesor_externo,
            a.asesor_externo_puesto,
            a.nombre_firmara,
            a.nombre_firmara_puesto,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            est.numero_control,
            est.domicilio AS domicilio_est,
            est.email AS email_est,
            est.seguridad_social,
            est.no_seguridad_social,
            est.ciudad AS ciudad_estudiante,
            est.telefono AS telefono_estudiante
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN departamentos depto ON car.id = depto.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        LEFT JOIN periodos per ON r.periodo_id = per.id
        WHERE r.estudiante_id = :idestudiante
        ";
        $resultado = DB::select($sql, ['idestudiante' => $estudianteId]);
        if (!empty($resultado)) {
            $datosEstudiante = $resultado[0];
        } else {
            echo "No se encontró el residente";
            return;
        }


        $templatePath = public_path('/formatos/TecNM-AC-PO-004-01-Solicitud-de-residencias-profesionales-por-competencias.docx');
        if (file_exists($templatePath)) {
            $templateProcessor = new TemplateProcessor($templatePath);
            $cantidad = Residencia::where('periodo_id', $datosEstudiante->periodo_id)->count();

            $fechaInicio = Carbon::parse($datosEstudiante->fecha_inicio);
            $fecha = $fechaInicio->isoFormat('DD [de] MMMM [de] YYYY');


            $templateProcessor->setValue('3', $fecha);
            $templateProcessor->setValue('5', $datosEstudiante->jefe_carrera);
            $templateProcessor->setValue('6', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('7', $datosEstudiante->nombre_proyecto);
            $templateProcessor->setValue('8_1', ($datosEstudiante->tipo_proyecto === 'Banco de Proyectos') ? 'x' : '');
            $templateProcessor->setValue('8_2', ($datosEstudiante->tipo_proyecto === 'Propuesta propia') ? 'x' : '');
            $templateProcessor->setValue('8_3', ($datosEstudiante->tipo_proyecto === 'Trabajador') ? 'x' : '');
            $templateProcessor->setValue('9', $datosEstudiante->periodo_proyectado);
            $templateProcessor->setValue('10', $cantidad);
            $templateProcessor->setValue('11', $datosEstudiante->nombre_empresa);
            $templateProcessor->setValue('12_1', ($datosEstudiante->giro === 'Industrial') ? 'x' : '');
            $templateProcessor->setValue('12_2', ($datosEstudiante->giro === 'Servicios') ? 'x' : '');
            $templateProcessor->setValue('12_3', ($datosEstudiante->giro === 'Otro') ? 'x' : '');
            $templateProcessor->setValue('12_4', ($datosEstudiante->giro === 'Público') ? 'x' : '');
            $templateProcessor->setValue('12_5', ($datosEstudiante->giro === 'Privado') ? 'x' : '');
            $templateProcessor->setValue('13', $datosEstudiante->rfc);
            $templateProcessor->setValue('14', $datosEstudiante->domicilio_empresa);
            $templateProcessor->setValue('15', $datosEstudiante->colonia_empresa);
            $templateProcessor->setValue('16', $datosEstudiante->cp_empresa);
            $templateProcessor->setValue('18', $datosEstudiante->ciudad_empresa);
            $templateProcessor->setValue('19', $datosEstudiante->telefono_empresa);
            $templateProcessor->setValue('20', $datosEstudiante->mision_empresa);
            $templateProcessor->setValue('21', $datosEstudiante->nombre_titular);
            $templateProcessor->setValue('22', $datosEstudiante->titular_puesto);
            $templateProcessor->setValue('23', $datosEstudiante->asesor_externo);
            $templateProcessor->setValue('24', $datosEstudiante->asesor_externo_puesto);
            $templateProcessor->setValue('25', $datosEstudiante->nombre_firmara);
            $templateProcessor->setValue('26', $datosEstudiante->nombre_firmara_puesto);
            $templateProcessor->setValue('27', $datosEstudiante->nombre_estudiante);
            $templateProcessor->setValue('28', $datosEstudiante->nombre_carrera);
            $templateProcessor->setValue('29', $datosEstudiante->numero_control);
            $templateProcessor->setValue('30', $datosEstudiante->domicilio_est);
            $templateProcessor->setValue('31', $datosEstudiante->email_est);
            $templateProcessor->setValue('32_1', ($datosEstudiante->seguridad_social === 'IMSS') ? 'x' : '');
            $templateProcessor->setValue('32_2', ($datosEstudiante->seguridad_social === 'ISSSTE') ? 'x' : '');
            $templateProcessor->setValue('32_3', ($datosEstudiante->seguridad_social === 'OTROS') ? 'x' : '');
            $templateProcessor->setValue('32', $datosEstudiante->no_seguridad_social);
            $templateProcessor->setValue('33', $datosEstudiante->ciudad_estudiante);
            $templateProcessor->setValue('34', $datosEstudiante->telefono_estudiante);

            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-01-solicitud-residencia-" . $datosEstudiante->numero_control . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        }
    }
}
