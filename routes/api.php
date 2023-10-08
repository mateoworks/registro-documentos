<?php

use App\Http\Controllers\Auth\CurrentUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Estudiante\HomeController;
use App\Http\Controllers\Recursos\CarreraController;
use App\Http\Controllers\Recursos\DepartamentoController;
use App\Http\Controllers\Recursos\DocumentoController;
use App\Http\Controllers\Recursos\PeriodoController;
use App\Http\Controllers\Residencia\EmpresaController;
use App\Http\Controllers\Residencia\EstudianteController;
use App\Http\Controllers\Residencia\ResidenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', LoginController::class)->name('login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('current-user', CurrentUserController::class)->name('current-user');

    Route::apiResource('users', UserController::class)->names('users');
    Route::get('users-trashed', [UserController::class, 'indexTrashed'])->name('users.trashed');
    Route::patch('users-restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users-force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    Route::apiResource('departamentos', DepartamentoController::class)->names('departamentos');
    Route::get('departamentos-trashed', [DepartamentoController::class, 'indexTrashed'])->name('departamentos.trashed');
    Route::patch('departamentos-restore', [DepartamentoController::class, 'restore'])->name('departamentos.restore');
    Route::delete('departamentos-force-delete', [DepartamentoController::class, 'forceDelete'])->name('departamentos.forceDelete');

    Route::apiResource('carreras', CarreraController::class)->names('carreras');
    Route::get('carreras-trashed', [CarreraController::class, 'indexTrashed'])->name('carreras.trashed');
    Route::patch('carreras-restore', [CarreraController::class, 'restore'])->name('carreras.restore');
    Route::delete('carreras-force-delete', [CarreraController::class, 'forceDelete'])->name('carreras.forceDelete');

    Route::apiResource('documentos', DocumentoController::class)->names('documentos');
    Route::get('documentos-trashed', [DocumentoController::class, 'indexTrashed'])->name('documentos.trashed');
    Route::patch('documentos-restore', [DocumentoController::class, 'restore'])->name('documentos.restore');
    Route::delete('documentos-force-delete', [DocumentoController::class, 'forceDelete'])->name('documentos.forceDelete');


    Route::apiResource('periodos', PeriodoController::class)->names('periodos');
    Route::get('periodos-trashed', [PeriodoController::class, 'indexTrashed'])->name('periodos.trashed');
    Route::patch('periodos-restore', [PeriodoController::class, 'restore'])->name('periodos.restore');
    Route::delete('periodos-force-delete', [PeriodoController::class, 'forceDelete'])->name('periodos.forceDelete');

    Route::apiResource('empresas', EmpresaController::class)->names('empresas');
    Route::get('empresas-trashed', [EmpresaController::class, 'indexTrashed'])->name('empresas.trashed');
    Route::patch('empresas-restore', [EmpresaController::class, 'restore'])->name('empresas.restore');
    Route::delete('empresas-force-delete', [EmpresaController::class, 'forceDelete'])->name('empresas.forceDelete');

    Route::apiResource('estudiantes', EstudianteController::class)->names('estudiantes');
    Route::get('estudiantes-trashed', [EstudianteController::class, 'indexTrashed'])->name('estudiantes.trashed');
    Route::patch('estudiantes-restore', [EstudianteController::class, 'restore'])->name('estudiantes.restore');
    Route::delete('estudiantes-force-delete', [EstudianteController::class, 'forceDelete'])->name('estudiantes.forceDelete');

    Route::apiResource('estudiantes', EstudianteController::class)->names('estudiantes');

    Route::get('periodo-activo', [ResidenciaController::class, 'periodoActivo'])->name('residencia.periodo');
    Route::patch('asignar-residencia/{estudiante}', [ResidenciaController::class, 'asignarResidencia'])
        ->name('residencia.asignar');
    Route::get('empresas-select', [ResidenciaController::class, 'empresas'])
        ->name('residencia.autocompleteempresa');

    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('estudiante-index', HomeController::class)->name('estudiante.index');
});
