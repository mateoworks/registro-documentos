<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Http\Requests\StoreEntregaRequest;
use App\Http\Requests\UpdateEntregaRequest;
use App\Http\Resources\EntregaResource;
use App\Models\Documento;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                ->from('residencias')
                ->whereIn('periodo_id', function ($subquery) {
                    $subquery->select('periodo_id')
                        ->from('residencias')
                        ->join('periodos', 'periodos.id', '=', 'residencias.periodo_id')
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

        $existingEntrega = Entrega::where('estudiante_id', $data['estudiante_id'])
            ->where('documento_id', $data['documento_id'])
            ->first();

        if ($existingEntrega) {
            return response()->json([
                'errors' => [
                    'custom_error' => ['Ya se agregó este documento al mismo residente.'],
                ],
                'message' => 'Ya se agregó este documento al mismo residente.',
            ], 422);
        }

        if ($request->hasFile('url_documento')) {
            $data['url_documento'] = $this->storeFile(
                $request->file('url_documento'),
                'documentos',
                $data['estudiante_id'],
                $data['documento_id'],
            );
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
            $data['url_documento'] = $this->storeFile(
                $request->file('url_documento'),
                'documentos',
                $data['estudiante_id'],
                $data['documento_id'],
            );
        }
        $entrega->update($data);
        return EntregaResource::make($entrega);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        $this->authorize('eliminar entregas');
        $entrega->delete();
    }


    private function periodoYNumControl($id)
    {
        $result = DB::select('
            SELECT e.numero_control, p.nombre AS nombre_periodo
            FROM estudiantes AS e
            JOIN residencias AS ee ON e.id = ee.estudiante_id
            JOIN periodos AS p ON ee.periodo_id = p.id
            WHERE e.id = :estudianteId
            ORDER BY p.created_at ASC
            LIMIT 1
        ', ['estudianteId' => $id]);
        $data = [];
        if (!empty($result)) {
            $data['numero_control'] = $result[0]->numero_control;
            $data['nombre_periodo'] = $result[0]->nombre_periodo;
        }
        return $data;
    }
    private function storeFile(UploadedFile $file, $folder, $idEstudiante, $idDocumento)
    {
        $extension = $file->getClientOriginalExtension();
        $nombreDoc = Documento::findOrFail($idDocumento);
        $periodoYcontrol = $this->periodoYNumControl($idEstudiante);
        $periodoSlug = Str::slug($periodoYcontrol['nombre_periodo']);
        $nombreDocumentoSlug = Str::slug($nombreDoc->nombre_documento);
        $numeroControl = $periodoYcontrol['numero_control'];
        $nombreArchivo = $numeroControl . '_' . $nombreDocumentoSlug;
        $i = 1;
        while (Storage::disk('public')->exists("$folder/$periodoSlug/$nombreArchivo.$extension")) {
            $nombreArchivo = Str::slug($nombreArchivo) . '-' . $i;
            $i++;
        }

        $filePath = $file->storeAs("$folder/$periodoSlug", "$nombreArchivo.$extension", 'public');
        return $filePath;
    }
}
