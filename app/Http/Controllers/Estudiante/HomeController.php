<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userAuth = Auth::user();
        $user = User::where('id', $userAuth->id)->first();
        /* if (!$user->hasRoles('estudiante')) {
            return 'Error';
        } */
        $id = $userAuth->id;
        //$estudiante = $user->estudiante;

        $estudiante = Estudiante::where('user_id', $id)->first();
        $estudiante->load('carrera');

        $periodos = $estudiante->periodos;
        $periodos->load('empresas');
        $entregas = Entrega::where('estudiante_id', $estudiante->id)->get();
        //$documentos = $entregas->documentos;
        return response()->json([
            'user' => $user,
            'estudiante' => $estudiante,
            'periodos' => $periodos,
            'entregas' => $entregas,
        ]);
    }
}
