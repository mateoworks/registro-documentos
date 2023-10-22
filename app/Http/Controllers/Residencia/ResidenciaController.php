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

        // Validar si el estudiante ya tiene una asignación de residencia en el período activo
        $existingAssignment = $estudiante->empresas()
            ->where('periodo_id', $periodo->id)
            ->where('actividad', 'Residencia profesional')
            ->count();

        if ($existingAssignment > 0) {
            return response()->json(['message' => 'El estudiante ya tiene una asignación de residencia en este período activo'], 422);
        }

        // Si no hay una asignación existente, agregar la asignación
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
