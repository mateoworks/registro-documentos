<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class DictamenAnteproyectos extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $carreraId)
    {
        if ($request->query('periodo_id')) {
            $periodoId = $request->query('periodo_id');
            $periodo = Periodo::findOrFail($periodoId);
        } else {
            $periodo = Periodo::where('activo', 1)->first();
            $periodoId = $periodo->id;
        }
        $sql = "
        SELECT
            est.numero_control,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            est.genero AS sexo,
            proy.nombre AS nombre_proyecto,
            emp.nombre AS nombre_empresa,
            CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor_inter,
            a.asesor_externo
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
        WHERE est.carrera_id=:carreraId AND r.periodo_id = :periodoId
        ";
        $resultado = DB::select($sql, ['carreraId' => $carreraId, 'periodoId' => $periodoId]);
        $values = [];
        $i = 1;
        if (!empty($resultado)) {
            foreach ($resultado as $row) {
                $values[] = [
                    '3' => $i,
                    '4' => $row->numero_control,
                    '5' => $row->nombre_estudiante,
                    '6' => $row->sexo,
                    '7' => $row->nombre_proyecto,
                    '8' => $row->nombre_empresa,
                    '9_1' => $row->asesor_inter,
                    '9_2' => $row->asesor_externo,
                ];
                $i++;
            }
        } else {
            return;
        }
        $sqlDepto = "
        SELECT
            d.nombre nombre_depto,
            CONCAT(d.nombre_titular, ' ', d.apellidos_titular) AS nombre_titular
        FROM carreras c
        LEFT JOIN departamentos d ON c.departamento_id = d.id
        WHERE c.id = :carreraId
        ";
        $deptoConsulta = DB::select($sqlDepto, ['carreraId' => $carreraId]);
        if (!empty($deptoConsulta)) {
            $depto = $deptoConsulta[0];
        }

        $templatePath = public_path('/formatos/TecNM-AC-PO-004-04-Dictamen-de-anteproyectos-de-residencias-profesionales.docx');
        if (file_exists($templatePath)) {
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->cloneRowAndSetValues('3', $values);

            $templateProcessor->setValue('2', strtoupper($depto->nombre_depto));
            $templateProcessor->setValue('12', strtoupper($depto->nombre_titular));
            $templateProcessor->setValue('15_1', strpos($periodo->nombre, 'Ene') !== false ? 'x' : '');
            $templateProcessor->setValue('15_2', strpos($periodo->nombre, 'Ago') !== false ? 'x' : '');

            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-04-Dictamen-de-anteproyectos-de-residencias-profesionales-" . $carreraId . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        }
    }
}
