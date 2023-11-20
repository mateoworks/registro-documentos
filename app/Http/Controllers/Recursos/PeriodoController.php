<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Http\Resources\PeriodoResource;
use Illuminate\Http\Request;

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

    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion periodos');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Periodo::whereIn('id', $ids)->forceDelete();
        return response()->json(['message' => 'Eliminación completada']);
    }

    public function restore(Request $request)
    {
        $this->authorize('restaurar periodos');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Periodo::whereIn('id', $ids)->restore();
        return response()->json(['message' => 'Restauración exitosa']);
    }

    public function indexTrashed()
    {
        $periodos = Periodo::onlyTrashed()->get();
        return PeriodoResource::collection($periodos);
    }
}
