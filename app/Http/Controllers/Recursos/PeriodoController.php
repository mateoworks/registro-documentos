<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Http\Resources\PeriodoResource;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver periodos');
        $periodos = Periodo::included()->filter()->sort()->getOrPaginate();
        return PeriodoResource::collection($periodos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeriodoRequest $request)
    {
        $this->authorize('crear periodos');
        $periodo = Periodo::create($request->all());
        return PeriodoResource::make($periodo);
    }

    /**
     * Display the specified resource.
     */
    public function show($periodo)
    {
        $this->authorize('ver periodos', $periodo);
        $periodo = Periodo::included()->findOrFail($periodo);
        return PeriodoResource::make($periodo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriodoRequest $request, Periodo $periodo)
    {
        $this->authorize('editar periodos', $periodo);
        $periodo->update($request->all());
        return PeriodoResource::make($periodo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodo $periodo)
    {
        $this->authorize('eliminar periodos');
        $periodo->delete();
    }
    public function restore($periodo)
    {
        $this->authorize('restaurar periodos');
        $restoredPeriodo = Periodo::withTrashed()->findOrFail($periodo);
        $restoredPeriodo->restore();
        return PeriodoResource::make($restoredPeriodo);
    }
    public function forceDelete(Periodo $periodo)
    {
        $this->authorize('forzar eliminacion periodos');
        $periodo->forceDelete();
    }
}
