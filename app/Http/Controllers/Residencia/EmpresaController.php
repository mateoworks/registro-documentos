<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Http\Resources\EmpresaResource;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver empresas');
        $empresas = Empresa::included()->filter()->sort()->getOrPaginate();
        return EmpresaResource::collection($empresas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpresaRequest $request)
    {
        $this->authorize('crear empresas');
        $empresa = Empresa::create($request->all());
        return EmpresaResource::make($empresa);
    }

    /**
     * Display the specified resource.
     */
    public function show($empresa)
    {
        $this->authorize('ver empresas', $empresa);
        $empresa = Empresa::included()->findOrFail($empresa);
        return EmpresaResource::make($empresa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        $this->authorize('editar empresas', $empresa);
        $empresa->update($request->all());
        return EmpresaResource::make($empresa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $this->authorize('eliminar empresas');
        $empresa->delete();
    }
    public function restore(Request $request)
    {
        $this->authorize('restaurar empresas');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Empresa::whereIn('id', $ids)->restore();

        return response()->json(['message' => 'Restauración exitosa']);
    }
    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion empresas');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Empresa::whereIn('id', $ids)->forceDelete();
        return response()->json(['message' => 'Eliminado con éxito!']);
    }

    public function indexTrashed()
    {
        $empresas = Empresa::onlyTrashed()->get();
        return EmpresaResource::collection($empresas);
    }
}
