<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Http\Resources\ProyectoResource;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver proyectos');
        $proyectos = Proyecto::included()->filter()->sort()->getOrPaginate();
        return ProyectoResource::collection($proyectos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request)
    {
        $this->authorize('crear proyectos');
        $proyecto = Proyecto::create($request->all());
        return ProyectoResource::make($proyecto);
    }

    /**
     * Display the specified resource.
     */
    public function show($proyecto)
    {
        $this->authorize('ver proyectos', $proyecto);
        $proyecto = Proyecto::included()->findOrFail($proyecto);
        return ProyectoResource::make($proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto)
    {
        $this->authorize('editar proyectos', $proyecto);
        $proyecto->update($request->all());
        return ProyectoResource::make($proyecto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('eliminar proyectos', $proyecto);
        $proyecto->delete();
    }
    public function restore($proyecto)
    {
        $this->authorize('restaurar proyectos');
        $restoredProyecto = Proyecto::withTrashed()->findOrFail($proyecto);
        $restoredProyecto->restore();
        return ProyectoResource::make($proyecto);
    }
    public function forceDelete(Proyecto $proyecto)
    {
        $this->authorize('forzar eliminacion proyectos');
        $proyecto->forceDelete();
    }
}
