<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExportPDFController extends Controller
{
    public function exportResidentesPorCarrera($carrera)
    {
        $car = Carrera::findOrFail($carrera);
        $urlApp = config('app.url') . '/storage/';
        $sql = "
                SELECT
                e.id AS estudiante_id,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo,
                IF(u.url_foto IS NULL OR u.url_foto = '', NULL, CONCAT('$urlApp', u.url_foto)) AS url_foto,
                CONCAT(LEFT(e.nombre, 1), LEFT(e.apellidos, 1)) AS iniciales_nombre_apellido,
                c.abrev AS nombre_carrera,
                c.color AS color_carrera,
                CONCAT(emp.nombre, ' - ', a.nombre) AS nombre_empresa,
                emp.telefono AS telefono_empresa,
                e.telefono AS telefono_estudiante,
                e.numero_control AS numero_control_estudiante,
                pr.nombre AS proyecto,
                pr.tipo AS tipo_proyecto,
                CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor_interno
            FROM residencias AS ee
            INNER JOIN estudiantes AS e ON ee.estudiante_id = e.id
            INNER JOIN users AS u ON e.user_id = u.id
            INNER JOIN carreras AS c ON e.carrera_id = c.id
            INNER JOIN areas AS a ON ee.area_id = a.id
            INNER JOIN empresas AS emp ON a.empresa_id = emp.id
            INNER JOIN periodos AS p ON ee.periodo_id = p.id
            LEFT JOIN proyectos AS pr ON ee.proyecto_id = pr.id
            LEFT JOIN asesor_interno AS ai ON ee.asesor_interno_id = ai.id
            WHERE p.activo = 1
            AND c.id = :carreraId
            AND e.deleted_at IS NULL;
        ";
        $residentes = DB::select($sql, ["carreraId" => $carrera]);
        $car['escudo'] = $urlApp . $car['escudo'];

        /* if (!Storage::exists('public/perfil/thumbnails')) {
            Storage::makeDirectory('public/perfil/thumbnails');
        } */
        /* foreach ($residentes as $residente) {
            if (!empty($residente->url_foto)) {
                $image = \Image::make($residente->url_foto);

                $image->resize(80, 80);

                $thumbnailPath = storage_path("app/public/perfil/thumbnails/{$residente->estudiante_id}.jpg");
                $image->save($thumbnailPath);

                $residente->url_foto = $urlApp . "perfil/thumbnails/" . $residente->estudiante_id . ".jpg";
            }
        } */
        $periodo = Periodo::where('activo', true)->first();
        $data = [
            'periodo' => $periodo,
            'residentes' => $residentes,
            'carrera' => $car,
        ];
        set_time_limit(0);
        $pdf = Pdf::loadView('pdf.residentes-carrera', $data, ['size' => 'letter']);
        $nombrePeriodoSlug = Str::slug($periodo->nombre);
        $filename = now()->format('Y-m-d') . '_Residentes' . '_' . $car->abrev . '-' . $nombrePeriodoSlug . '.pdf';
        return $pdf->download($filename);
    }

    public function exportResidentes()
    {
        $urlApp = config('app.url') . '/storage/';
        $sql = "
            SELECT
                e.id AS estudiante_id,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo,
                IF(u.url_foto IS NULL OR u.url_foto = '', NULL, CONCAT('$urlApp', u.url_foto)) AS url_foto,
                CONCAT(LEFT(e.nombre, 1), LEFT(e.apellidos, 1)) AS iniciales_nombre_apellido,
                c.abrev AS nombre_carrera,
                c.color AS color_carrera,
                CONCAT(emp.nombre, ' - ', a.nombre) AS nombre_empresa,
                emp.telefono AS telefono_empresa,
                e.telefono AS telefono_estudiante,
                e.numero_control AS numero_control_estudiante,
                pr.nombre AS proyecto,
                pr.tipo AS tipo_proyecto,
                CONCAT(ai.nombre, ' ', ai.apellidos) AS asesor_interno
            FROM residencias AS ee
            INNER JOIN estudiantes AS e ON ee.estudiante_id = e.id
            INNER JOIN users AS u ON e.user_id = u.id
            INNER JOIN carreras AS c ON e.carrera_id = c.id
            INNER JOIN areas AS a ON ee.area_id = a.id
            INNER JOIN empresas AS emp ON a.empresa_id = emp.id
            INNER JOIN periodos AS p ON ee.periodo_id = p.id
            LEFT JOIN proyectos AS pr ON ee.proyecto_id = pr.id
            LEFT JOIN asesor_interno AS ai ON ee.asesor_interno_id = ai.id
            WHERE p.activo = 1
            AND e.deleted_at IS NULL;
        ";
        $residentes = DB::select($sql);

        /* if (!Storage::exists('public/perfil/thumbnails')) {
            Storage::makeDirectory('public/perfil/thumbnails');
        } */

        /* foreach ($residentes as $residente) {
            if (!empty($residente->url_foto)) {
                $image = \Image::make($residente->url_foto);

                $image->resize(80, 80);

                $thumbnailPath = storage_path("app/public/perfil/thumbnails/{$residente->estudiante_id}.jpg");
                $image->save($thumbnailPath);

                $residente->url_foto = $urlApp . "perfil/thumbnails/" . $residente->estudiante_id . ".jpg";
            }
        } */
        $periodo = Periodo::where('activo', true)->first();
        $data = [
            'periodo' => $periodo,
            'residentes' => $residentes,
        ];
        set_time_limit(0);
        $pdf = Pdf::loadView('pdf.residentes', $data, ['size' => 'letter']);
        $nombrePeriodoSlug = Str::slug($periodo->nombre);
        $filename = now()->format('Y-m-d') . '_Residentes' . '_' . $nombrePeriodoSlug . '.pdf';
        return $pdf->download($filename);
    }
}
