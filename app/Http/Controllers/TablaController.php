<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Entrega;
use App\Models\Estudiante;
use App\Models\Periodo;
use Illuminate\Http\Request;

class TablaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $estudiantes = Estudiante::all();
        $documentos = Documento::all();
        $entregas = Entrega::all(); // Ajusta la obtención según tus necesidades

        // Organiza los datos para acceder al estado de entrega de cada documento por estudiante
        $data = [];
        foreach ($estudiantes as $estudiante) {
            $data[$estudiante->id] = [];
            foreach ($documentos as $documento) {
                $data[$estudiante->id][$documento->id] = $this->getEstadoEntrega($entregas, $estudiante->id, $documento->id);
            }
        }

        return view('tabla', compact('estudiantes', 'documentos', 'data'));
    }

    private function getEstadoEntrega($entregas, $estudianteId, $documentoId)
    {
        foreach ($entregas as $entrega) {
            if ($entrega->estudiante_id == $estudianteId && $entrega->documento_id == $documentoId) {
                return 1;
            }
        }
        return 0;
    }


    public function obtenerDatos()
    {
        $periodoActivo = Periodo::where('activo', true)->first();
        if ($periodoActivo) {
            $estudiantes = $periodoActivo->estudiantes;
            $estudiantes->load('carrera');
            $documentos = Documento::all();
            $entregas = Entrega::all(); // Ajusta la obtención según tus necesidades

            // Organiza los datos para acceder al estado de entrega de cada documento por estudiante
            $data = [];
            foreach ($estudiantes as $estudiante) {
                $data[$estudiante->id] = [];
                foreach ($documentos as $documento) {
                    $data[$estudiante->id][$documento->id] = $this->getEstadoEntrega($entregas, $estudiante->id, $documento->id);
                }
            }

            return response()->json([
                'estudiantes' => $estudiantes,
                'documentos' => $documentos,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'estudiantes' => [],
                'documentos' => [],
                'data' => [],
            ]);
        }
    }
}
