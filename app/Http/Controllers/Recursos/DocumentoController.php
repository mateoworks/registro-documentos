<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Resources\DocumentoResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver documentos');
        $documentos = Documento::included()->filter()->sort()->latest()->getOrPaginate();
        return DocumentoResource::collection($documentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentoRequest $request)
    {
        $this->authorize('crear documentos');
        $data = $request->all();
        if ($request->hasFile('url_formato')) {
            $userProvidedName = $data['nombre_documento'];
            $uniqueName = $this->uniqueNameWithUserProvidedName($request->file('url_formato'), $userProvidedName, 'formatos');
            $data['url_formato'] = $request->file('url_formato')->storeAs('formatos', $uniqueName, 'public');
        }
        $documento = Documento::create($data);
        return DocumentoResource::make($documento);
    }

    /**
     * Display the specified resource.
     */
    public function show($documento)
    {
        $this->authorize('ver documentos');
        $documento = Documento::included()->findOrFail($documento);
        return DocumentoResource::make($documento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {
        $this->authorize('editar documentos', $documento);
        $data = $request->all();
        if ($request->hasFile('url_formato')) {
            if ($documento->url_formato) {
                Storage::disk('public')->delete($documento->url_formato);
            }

            $userProvidedName = $data['nombre_documento'];
            $uniqueName = $this->uniqueNameWithUserProvidedName($request->file('url_formato'), $userProvidedName, 'formatos');
            $data['url_formato'] = $request->file('url_formato')->storeAs('formatos', $uniqueName, 'public');
        }
        $documento->update($data);
        return DocumentoResource::make($documento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        $this->authorize('eliminar documentos', $documento);
        $documento->delete();
    }

    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion documentos');

        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        foreach ($ids as $id) {
            $documento = Documento::withTrashed()->find($id);

            if ($documento) {
                $documento->forceDelete();
            }
        }

        return response()->json(['message' => 'Restauración exitosa']);
    }

    public function restore(Request $request)
    {
        $this->authorize('restaurar documentos');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        Documento::whereIn('id', $ids)->restore();

        return response()->json(['message' => 'Restauración exitosa']);
    }

    public function indexTrashed()
    {
        $departamentos = Documento::onlyTrashed()->included()->get();
        return DocumentoResource::collection($departamentos);
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }

    private function uniqueNameWithUserProvidedName($file, $userProvidedName, $folder)
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($userProvidedName);
        $i = 1;
        while (Storage::disk('public')->exists("$folder/$slug.$extension")) {
            $slug = Str::slug($userProvidedName) . '-' . $i;
            $i++;
        }
        return "$slug.$extension";
    }
}
