<?php

namespace App\Http\Controllers\Formatos;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;

class PublicacionResultados extends Controller
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
        $carrera = Carrera::findOrFail($carreraId);
        $sql = "
        SELECT
            proy.nombre AS nombre_proyecto,
            CONCAT(est.nombre, ' ', est.apellidos) AS nombre_estudiante,
            CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor_inter
        FROM residencias r
        LEFT JOIN estudiantes est ON r.estudiante_id = est.id
        LEFT JOIN carreras car ON est.carrera_id = car.id
        LEFT JOIN proyectos proy ON r.proyecto_id = proy.id
        LEFT JOIN asesor_interno ai ON r.asesor_interno_id = ai.id
        WHERE est.carrera_id=:carreraId AND r.periodo_id = :periodoId
        ";
        $resultado = DB::select($sql, ['carreraId' => $carreraId, 'periodoId' => $periodoId]);
        $values = [];
        if (!empty($resultado)) {
            foreach ($resultado as $row) {
                $values[] = [
                    '3' => $row->nombre_proyecto,
                    '4' => $row->nombre_estudiante,
                    '5' => $row->asesor_inter,
                ];
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

        $templatePath = public_path('/formatos/TecNM-AC-PO-004-05-Publicacion-de-resultados-de-proyectos-de-residencias.docx');

        if (file_exists($templatePath)) {
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->cloneRowAndSetValues('3', $values);

            $templateProcessor->setValue('2', strtoupper($depto->nombre_depto));
            $templateProcessor->setValue('8', strtoupper($depto->nombre_titular));

            $documentoGenerado = storage_path('app/temp/documento-generado.docx');

            // Verifica si el directorio no existe, intenta crearlo
            if (!file_exists(dirname($documentoGenerado))) {
                // Intenta crear el directorio con permisos adecuados (por ejemplo, 0755)
                mkdir(dirname($documentoGenerado), 0755, true);
            }

            // Intenta guardar el documento generado
            $templateProcessor->saveAs($documentoGenerado);


            // Descargar el documento generado
            $nombreDoc = "TecNM-AC-PO-004-05-Publicacion-de-resultados-de-proyectos-de-residencias-" . $carreraId . ".docx";
            return Response::download($documentoGenerado, $nombreDoc)->deleteFileAfterSend(true);
        }
    }
}
