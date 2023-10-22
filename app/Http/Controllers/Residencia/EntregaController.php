<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Http\Requests\StoreEntregaRequest;
use App\Http\Requests\UpdateEntregaRequest;
use App\Http\Resources\EntregaResource;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver entregas');
        $entregas = Entrega::whereIn('estudiante_id', function ($query) {
            $query->select('estudiante_id')
                ->from('empresa_estudiante')
                ->whereIn('periodo_id', function ($subquery) {
                    $subquery->select('periodo_id')
                        ->from('empresa_estudiante')
                        ->join('periodos', 'periodos.id', '=', 'empresa_estudiante.periodo_id')
                        ->where('periodos.activo', true);
                });
        })
            ->orderBy('created_at', 'desc')
            ->included()->filter()->getOrPaginate();
        return EntregaResource::collection($entregas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntregaRequest $request)
    {
        $this->authorize('crear entregas');
        $data = $request->all();
        if ($request->hasFile('url_documento')) {
            $data['url_documento'] = $this->storeFile($request->file('url_documento'), 'documentos');
        }
        $entrega = Entrega::create($data);
        return EntregaResource::make($entrega);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('ver entregas');
        $entrega = Entrega::included()->findOrFail($id);
        return EntregaResource::make($entrega);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntregaRequest $request, Entrega $entrega)
    {
        $this->authorize('editar entregas');
        $data = $request->all();
        if ($request->hasFile('url_documento')) {
            if ($entrega->url_documento) {
                Storage::disk('public')->delete($entrega->url_documento);
            }
            $data['url_documento'] = $this->storeFile($request->file('url_documento'), 'documentos');
        }
        $entrega->update($data);
        return EntregaResource::make($entrega);
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        $this->authorize('eliminar entregas');
        $entrega->delete();
    }

    public function indexTrashed()
    {
        $users = Entrega::withTrashed()
            ->onlyTrashed()
            ->included()
            ->get();
        return EntregaResource::collection($users);
    }

    public function restore(Request $request)
    {
        $this->authorize('restaurar usuarios');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Entrega::whereIn('id', $ids)->restore();
        return response()->json(['message' => 'Restauración exitosa']);
    }

    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion usuarios');

        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        foreach ($ids as $id) {
            $entrega = Entrega::withTrashed()->find($id);
            if ($entrega) {
                $entrega->forceDelete();
            }
        }
        return response()->json(['message' => 'Eliminación exitosa']);
    }
}
