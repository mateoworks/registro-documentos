<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return AreaResource::collection($areas);
    }

    public function show($id)
    {
        $area = Area::findOrFail($id);
        return new AreaResource($area);
    }

    public function store(AreaRequest $request)
    {
        $area = Area::create($request->validated());
        return new AreaResource($area);
    }

    public function update(AreaRequest $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->validated());
        return new AreaResource($area);
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return response()->json(['message' => 'Area eliminada correctamente']);
    }

    public function areasPorEmpresa($empresaId)
    {
        $areas = Area::where('empresa_id', $empresaId)->get();
        return AreaResource::collection($areas);
    }

    public function areasEmpresasNombre()
    {
        $sql = "
        SELECT
            a.id,
            CONCAT(emp.nombre, ' - ', a.nombre) AS nombre
        FROM
        areas a
        LEFT JOIN empresas emp ON a.empresa_id = emp.id
        ";
        $areas = DB::select($sql);
        return response()->json($areas);
    }
}
