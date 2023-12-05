<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProyectoRequest;
use App\Http\Resources\PeriodoResource;
use App\Http\Resources\ProyectoResource;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //TODO: autorize
        $proyectos = Proyecto::included()->filter()->sort()->getOrPaginate();
        return ProyectoResource::collection($proyectos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProyectoRequest $request)
    {
        //TODO: autorize
        $proyecto = Proyecto::create($request->all());
        return PeriodoResource::make($proyecto);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //TODO: autorize
        $proyecto = Proyecto::included()->findOrFail($id);
        return ProyectoResource::make($proyecto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        //TODO: autorize
        $proyecto->update($request->all());
        return ProyectoResource::make($proyecto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //TODO: autorize
        $proyecto->delete();
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) >= 3) {
            $proyectos = DB::select(
                "SELECT id, nombre
                FROM proyectos
                WHERE nombre LIKE :query1",
                ['query1' => "%$query%"]
            );

            return response()->json($proyectos);
        }

        return response()->json([]);
    }
}
