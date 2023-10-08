<?php

namespace App\Http\Controllers\Residencia;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodoResource;
use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResidenciaController extends Controller
{
    public function periodoActivo()
    {
        $periodo = Periodo::where('activo', true)->first();
        if ($periodo) {
            return PeriodoResource::make($periodo);
        } else {
            return null;
        }
    }

    public function asignarResidencia(Request $request, Estudiante $estudiante)
    {

        $periodo = Periodo::where('activo', true)->first();
        Log::info('Empresa ' . $periodo->id);
        $estudiante->empresas()->attach($request->empresa_id, [
            'proyecto' => $request->proyecto,
            'periodo_id' => $periodo->id,
            'actividad' => 'Residencia profesional',
        ]);
        return response()->json(['message' => 'La asignación de residencia fue exitosa'], 200);
    }

    public function empresas(Request $request)
    {
        $empresas = Empresa::where('nombre', 'LIKE', '%' . $request->nombre . '%')
            ->select('id', 'nombre')
            ->get();
        return $empresas;
    }
}
