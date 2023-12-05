<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsesorInternoRequest;
use App\Http\Resources\AsesorInternoResource;
use App\Models\AsesorInterno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsesorInternoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //TODO: autorize
        $asesores = AsesorInterno::included()->filter()->sort()->getOrPaginate();
        return AsesorInternoResource::collection($asesores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AsesorInternoRequest $request)
    {
        //TODO: autorize
        $asesor = AsesorInterno::create($request->all());
        return AsesorInternoResource::make($asesor);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //TODO: autorize
        $asesor = AsesorInterno::included()->findOrFail($id);
        return AsesorInternoResource::make($asesor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AsesorInternoRequest $request, string $id)
    {
        //TODO: autorize
        $asesor = AsesorInterno::findOrFail($id);
        $asesor->update($request->all());
        return AsesorInternoResource::make($asesor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //TODO: autorize
        $asesor = AsesorInterno::findOrFail($id);
        $asesor->delete();
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) >= 3) {
            $asesores = DB::select(
                "SELECT id, CONCAT(nombre, ' ', apellidos) AS nombre_completo
                FROM asesor_interno
                WHERE nombre LIKE :query1
                OR apellidos LIKE :query2
                OR CONCAT(nombre, ' ', apellidos) LIKE :query3",
                ['query1' => "%$query%", 'query2' => "%$query%", 'query3' => "%$query%"]
            );

            return response()->json($asesores);
        }

        return response()->json([]);
    }
}
