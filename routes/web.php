<?php

use App\Http\Controllers\Residencia\FormatoController;
use App\Http\Controllers\TablaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('formato-carta-presentacion/{estudianteId}', [FormatoController::class, 'formatoCartaPresentacion'])
    ->name('formato.carta.presentacion');
