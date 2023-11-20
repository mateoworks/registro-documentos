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

Route::get('/tabla', TablaController::class)->name('tabla');
/* Route::get('{any}', function () {
    return view('app');
})->where('any', '.*'); */

Route::get('/formato', [FormatoController::class, 'formatoCartaPresentacion'])
    ->name('formato');
