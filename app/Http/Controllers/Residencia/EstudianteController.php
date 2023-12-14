<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Resources\EstudianteResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver estudiantes');
        $estudiantes = Estudiante::included()
            ->filter()
            ->orderBy('created_at', 'DESC')
            ->sort()
            ->getOrPaginate();
        return EstudianteResource::collection($estudiantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        $this->authorize('crear estudiantes');
        $data = $request->all();
        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = bcrypt('password');
        }
        $data['name'] = $request->nombre . ' ' . $request->apellidos;

        if ($request->hasFile('url_foto')) {
            $data['url_foto'] = $this->storeFile($request->file('url_foto'), 'perfil');
        }

        $user = User::create($data);
        $user->assignRole('estudiante');

        $data['user_id'] = $user->id;
        $estudiante = Estudiante::create($data);

        return EstudianteResource::make($estudiante);
    }

    /**
     * Display the specified resource.
     */
    public function show($estudiante)
    {
        $this->authorize('ver estudiantes', $estudiante);
        $estudiante = Estudiante::included()->findOrFail($estudiante);
        return EstudianteResource::make($estudiante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        $this->authorize('editar estudiantes', $estudiante);
        $data = $request->all();
        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        $data['name'] = $request->nombre . ' ' . $request->apellidos;
        $user = User::findOrFail($estudiante->user_id);

        if ($request->hasFile('url_foto')) {
            if ($user->url_foto) {
                Storage::disk('public')->delete($user->url_foto);
            }
            $data['url_foto'] = $this->storeFile($request->file('url_foto'), 'perfil');
        }

        $user->update($data);
        $estudiante->update($data);

        return EstudianteResource::make($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $this->authorize('eliminar estudiantes', $estudiante);
        $estudiante->delete();
    }

    public function indexTrashed()
    {
        $estudiantes = Estudiante::onlyTrashed()->included()->getOrPaginate();
        return EstudianteResource::collection($estudiantes);
    }
    public function restore(Request $request)
    {
        $this->authorize('restaurar estudiantes');
        $restoreEstudiante = Estudiante::withTrashed()->findOrFail($request->ids);
        $restoreEstudiante->restore();
        return EstudianteResource::make($restoreEstudiante);
    }
    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion estudiantes');
        $estudiante = Estudiante::withTrashed()->findOrFail($request->ids);
        $estudiante->forceDelete();
    }

    public function empresaResidencia($estudianteId)
    {
        $sql = "
        SELECT
            CONCAT(emp.nombre, ' - ', a.nombre) AS nombre_empresa,
            emp.*,
            a.nombre AS nombre_area,
            a.*
        FROM
        estudiantes est
        LEFT JOIN residencias r ON r.estudiante_id = est.id
        LEFT JOIN areas a ON r.area_id = a.id
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        WHERE est.id = :estudianteId
        ";
        $empresaConsulta = DB::select($sql, ['estudianteId' => $estudianteId]);
        $empresa = null;
        if ($empresaConsulta) {
            $empresa = $empresaConsulta[0];
        }
        return response()->json($empresa);
    }

    public function buscarEstudiante(Request $request)
    {
        $term = $request->query('q');
        $urlApp = config('app.url') . '/storage/';

        $sql = "
            SELECT
                IF(u.url_foto IS NULL OR u.url_foto = '', NULL, CONCAT('$urlApp', u.url_foto)) AS url_foto,
                CONCAT(e.nombre, ' ', e.apellidos) AS nombre_completo_estudiante,
                e.numero_control AS numero_control_estudiante,
                c.nombre AS nombre_carrera,
                c.color AS color_carrera,
                e.id AS id_estudiante,
                c.id AS id_carrera,
                CASE
                    WHEN ee.area_id IS NOT NULL THEN 1
                    ELSE 0
                END AS tiene_relacion_empresa,
                emp.nombre AS nombre_empresa,
                p.nombre AS nombre_periodo,
                emp.id AS id_empresa,
                CONCAT(LEFT(e.nombre, 1), LEFT(e.apellidos, 1)) AS iniciales_nombre_apellido,
                p.id AS id_periodo,
                p.activo AS perido_activo
            FROM estudiantes e
            LEFT JOIN users u ON e.user_id = u.id
            LEFT JOIN carreras c ON e.carrera_id = c.id
            LEFT JOIN residencias ee ON e.id = ee.estudiante_id
            LEFT JOIN areas a ON ee.id = a.id
            LEFT JOIN empresas emp ON a.empresa_id = emp.id
            LEFT JOIN periodos p ON ee.periodo_id = p.id
            WHERE
                CONCAT(e.nombre, ' ', e.apellidos) LIKE :term1
                OR e.numero_control LIKE :term2
                OR e.telefono LIKE :term3
            AND e.deleted_at IS NULL
        ";

        $resultados = DB::select($sql, ['term1' => "%$term%", 'term2' => "%$term%", 'term3' => "%$term%"]);

        return response()->json($resultados);
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
