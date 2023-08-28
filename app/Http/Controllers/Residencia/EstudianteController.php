<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Resources\EstudianteResource;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver estudiantes');
        $estudiantes = Estudiante::included()->filter()->sort()->getOrPaginate();
        return EstudianteResource::collection($estudiantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        $this->authorize('crear estudiantes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $this->authorize('ver estudiantes', $estudiante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        $this->authorize('editar estudiantes', $estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $this->authorize('eliminar estudiantes', $estudiante);
    }
}
