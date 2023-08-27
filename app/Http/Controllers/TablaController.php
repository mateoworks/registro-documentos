<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Entrega;
use App\Models\Estudiante;
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
            if ($entrega->student_id == $estudianteId && $entrega->documento_id == $documentoId) {
                return 'Entregado';
            }
        }
        return 'No entregado';
    }
}
