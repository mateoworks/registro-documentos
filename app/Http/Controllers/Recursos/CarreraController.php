<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;
use App\Http\Resources\CarreraResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver carreras');
        $carreras = Carrera::included()->filter()->sort()->getOrPaginate();
        return CarreraResource::collection($carreras);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarreraRequest $request)
    {
        $this->authorize('crear carreras');
        $data = $request->all();
        if ($request->hasFile('escudo')) {
            $data['escudo'] = $this->storeFile($request->file('escudo'), 'escudo');
        }
        $carrera = Carrera::create($data);
        return CarreraResource::make($carrera);
    }

    /**
     * Display the specified resource.
     */
    public function show($carrera)
    {
        $this->authorize('ver carreras');
        $carrera = Carrera::included()->findOrFail($carrera);
        return CarreraResource::make($carrera);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarreraRequest $request, Carrera $carrera)
    {
        $this->authorize('editar carreras', $carrera);
        $data = $request->all();
        if ($request->hasFile('escudo')) {
            if ($carrera->escudo) {
                Storage::disk('public')->delete($carrera->escudo);
            }
            $data['escudo'] = $this->storeFile($request->file('escudo'), 'escudo');
        }
        $carrera->update($data);
        return CarreraResource::make($carrera);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        $this->authorize('eliminar carreras', $carrera);
        $carrera->delete();
    }

    public function restore($carrera)
    {
        $this->authorize('restaurar carreras');
        $restoredCarrera = Carrera::withTrashed()->findOrFail($carrera);
        $restoredCarrera->restore();
        return CarreraResource::make($restoredCarrera);
    }

    public function forceDelete(Carrera $carrera)
    {
        $this->authorize('forzar eliminacion carreras');

        if ($carrera->escudo) {
            Storage::disk('public')->delete($carrera->url_foto);
        }
        $carrera->forceDelete();
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
