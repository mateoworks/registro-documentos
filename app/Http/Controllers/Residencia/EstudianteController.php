<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Resources\EstudianteResource;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver estudiantes');
        /* $periodo = Periodo::where('activo', true)->first();
        $estudiantes = $periodo->estudiantes;
        $estudiantes->load('carrera'); */
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
        } else {
            $data['password'] = bcrypt('password');
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
    public function restore($estudiante)
    {
        $this->authorize('restaurar estudiantes');
        $restoreEstudiante = Estudiante::withTrashed()->findOrFail($estudiante);
        $restoreEstudiante->restore();
        return EstudianteResource::make($restoreEstudiante);
    }
    public function forceDelete(Estudiante $estudiante)
    {
        $this->authorize('forzar eliminacion estudiantes');
        $estudiante->forceDelete();
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
