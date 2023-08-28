<?php

use App\Http\Controllers\Auth\CurrentUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Recursos\CarreraController;
use App\Http\Controllers\Recursos\DepartamentoController;
use App\Http\Controllers\Recursos\PeriodoController;
use App\Http\Controllers\Residencia\EstudianteController;
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
    Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    Route::apiResource('departamentos', DepartamentoController::class)->names('departamentos');

    Route::apiResource('carreras', CarreraController::class)->names('carreras');
    Route::patch('carreras/{carrera}/restore', [CarreraController::class, 'restore'])->name('carreras.restore');
    Route::delete('carreras/{carrera}/force-delete', [CarreraController::class, 'forceDelete'])->name('carreras.forceDelete');

    Route::apiResource('periodos', PeriodoController::class)->names('periodos');
    Route::patch('periodos/{periodo}/restore', [PeriodoController::class, 'restore'])->name('periodos.restore');
    Route::delete('periodos/{periodo}/force-delete', [PeriodoController::class, 'forceDelete'])->name('periodos.forceDelete');

    Route::apiResource('estudiantes', EstudianteController::class)->names('estudiantes');

    Route::post('logout', LogoutController::class)->name('logout');
});
