<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Http\Requests\UpdateDepartamentoRequest;
use App\Http\Resources\DepartamentoResource;
use App\Http\Resources\DocumentoResource;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver departamentos');
        $departamentos = Departamento::included()->filter()->sort()->getOrPaginate();
        return DepartamentoResource::collection($departamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartamentoRequest $request)
    {
        $this->authorize('crear departamentos');
        $data = $request->all();
        $departamento = Departamento::create($data);
        return DepartamentoResource::make($departamento);
    }

    /**
     * Display the specified resource.
     */
    public function show($departamento)
    {
        $this->authorize('ver departamentos');
        $departamento = Departamento::included()->findOrFail($departamento);
        return DepartamentoResource::make($departamento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartamentoRequest $request, Departamento $departamento)
    {
        $this->authorize('editar departamentos', $departamento);
        $data = $request->all();
        $departamento->update($data);
        return DepartamentoResource::make($departamento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        $this->authorize('eliminar departamentos', $departamento);
        $departamento->delete();
    }
    public function restore($departamento)
    {
        $this->authorize('restaurar departamentos', $departamento);
        $restoredDepto = Departamento::withTrashed()->findOrFail($departamento);
        $restoredDepto->restore();
        return DepartamentoResource::make($restoredDepto);
    }
    public function forceDelete(Departamento $departamento)
    {
        $this->authorize('forzar eliminacion departamentos', $departamento);
        $departamento->forceDelete();
    }
}
