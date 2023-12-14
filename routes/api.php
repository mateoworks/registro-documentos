<?php

use App\Http\Controllers\Auth\CurrentUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\UserEditController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Estudiante\HomeController;
use App\Http\Controllers\Formatos\AsignacionAsesor;
use App\Http\Controllers\Formatos\CartaPresentacion;
use App\Http\Controllers\Formatos\DictamenAnteproyectos;
use App\Http\Controllers\Formatos\InformeSemestral;
use App\Http\Controllers\Formatos\PublicacionResultados;
use App\Http\Controllers\Formatos\RegistroAsesoria;
use App\Http\Controllers\Formatos\SolicitudResidencia;
use App\Http\Controllers\Recursos\AsesorInternoController;
use App\Http\Controllers\Recursos\CarreraController;
use App\Http\Controllers\Recursos\DepartamentoController;
use App\Http\Controllers\Recursos\DocumentoController;
use App\Http\Controllers\Recursos\PeriodoController;
use App\Http\Controllers\Recursos\ProyectoController;
use App\Http\Controllers\Residencia\AreaController;
use App\Http\Controllers\Residencia\ConsultasController;
use App\Http\Controllers\Residencia\EmpresaController;
use App\Http\Controllers\Residencia\EntregaController;
use App\Http\Controllers\Residencia\EstadisticasController;
use App\Http\Controllers\Residencia\EstudianteController;
use App\Http\Controllers\Residencia\ExportPDFController;
use App\Http\Controllers\Residencia\FormatoController;
use App\Http\Controllers\Residencia\ResidenciaController;
use App\Http\Controllers\Residencia\UtilController;
use App\Http\Controllers\TablaController;
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
    Route::put('editar-portada', [UserEditController::class, 'editarPortada'])->name('editar-portada');
    Route::put('editar-avatar', [UserEditController::class, 'editarAvatar'])->name('editar-avatar');
    Route::put('editar-name', [UserEditController::class, 'editarName'])->name('editar-name');
    Route::put('editar-password', [UserEditController::class, 'editarPassword'])->name('editar-password');

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

    Route::apiResource('areas', AreaController::class)->names('areas');
    Route::get('areas-empresa/{empresaId}', [AreaController::class, 'areasPorEmpresa'])->name('areas.empresa');
    Route::get('areas-empresas-nombre', [AreaController::class, 'areasEmpresasNombre'])->name('areas.empresas.nombre');

    Route::apiResource('entregas', EntregaController::class)->names('entregas');

    Route::apiResource('proyectos', ProyectoController::class)->names('proyectos');
    Route::get('proyectos-autocomplete', [ProyectoController::class, 'autocomplete'])->name('proyectos.autocomplete');

    Route::apiResource('estudiantes', EstudianteController::class)->names('estudiantes');
    Route::get('estudiantes-trashed', [EstudianteController::class, 'indexTrashed'])->name('estudiantes.trashed');
    Route::patch('estudiantes-restore', [EstudianteController::class, 'restore'])->name('estudiantes.restore');
    Route::delete('estudiantes-force-delete', [EstudianteController::class, 'forceDelete'])->name('estudiantes.forceDelete');
    Route::get('buscar-estudiante', [EstudianteController::class, 'buscarEstudiante'])
        ->name('estudiantes.buscar');
    Route::get('estudiante-empresas/{estudianteId}', [EstudianteController::class, 'empresaResidencia'])->name('estudiantes.empresa');

    Route::apiResource('estudiantes', EstudianteController::class)->names('estudiantes');
    Route::apiResource('asesores', AsesorInternoController::class)->names('asesores');
    Route::get('asesores-autocomplete', [AsesorInternoController::class, 'autocomplete']);

    Route::get('periodo-activo', [ResidenciaController::class, 'periodoActivo'])->name('residencia.periodo');
    Route::patch('asignar-residencia/{estudiante}', [ResidenciaController::class, 'asignarResidencia'])
        ->name('residencia.asignar');

    Route::get('residentes', [ResidenciaController::class, 'residentes'])
        ->name('residencia.residentes');
    Route::get('residentes-ver/{residente}', [ResidenciaController::class, 'ver'])
        ->name('residencia.ver');
    Route::delete('residentes-cancelar/{estudiante}', [ResidenciaController::class, 'cancelarResidencia'])
        ->name('residencia.cancelar');
    Route::post('residentes-actualizar', [ResidenciaController::class, 'actualizarResidencia'])
        ->name('residencia.actualizar');
    Route::get('estudiantes-sin-residencia', [ResidenciaController::class, 'estudiantesSinResidencia'])
        ->name('estudiantes.sin.residencia');

    Route::get('entrega-por-residente', [ResidenciaController::class, 'entregasPorResidente'])
        ->name('residencia.entregasPorResidente');

    Route::get('empresas-select', [ResidenciaController::class, 'empresas'])
        ->name('residencia.autocompleteempresa');

    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('estudiante-index', HomeController::class)->name('estudiante.index');
    //Dashboard
    Route::get('num-residentes', [DashboardController::class, 'residentes'])->name('dashboard.numresidentes');
    Route::get('num-residentes-carrera', [DashboardController::class, 'estudiantesPorCarrera'])->name('dashboard.residentesporcarrera');
    Route::get('tabla', [TablaController::class, 'obtenerDatos'])->name('dashboard.tabla');

    //Otros
    Route::get('estudiante-autompletar', [UtilController::class, 'autocompletarEstudiante'])
        ->name('estudiantes.autocompletar');

    Route::get('documentos-pendientes', [UtilController::class, 'documentosPendientes'])
        ->name('estudiantes.documentosPendientes');

    //Estudiante datos
    Route::get('estudiante-carrera', [HomeController::class, 'carreraUser'])
        ->name('estudiante.carrera');
    Route::get('estudiante-datos', [HomeController::class, 'estudiante'])
        ->name('estudiante.datos');
    Route::get('estudiante-documentos-entregar', [HomeController::class, 'documentosEntregar'])
        ->name('estudiante.documentos.entregar');
    Route::get('estudiante-documentos-entregados', [HomeController::class, 'entregasPorEstudiante'])
        ->name('estudiante.documentos.entregados');
    Route::get('estudiante-residencia', [HomeController::class, 'datosResidencia'])
        ->name('estudiante.residencia');
    Route::get('residentes-por-carrera/{carreraId}', [ConsultasController::class, 'residentesPorCarrera'])
        ->name('residentes.por.carrera');
    Route::get('residentes-doc-pendientes/{estudianteId}', [ConsultasController::class, 'documentosPendientesPorEntregar'])
        ->name('residentes.doc.pendientes');

    //Estadística
    Route::get('residentes-por-periodo', [EstadisticasController::class, 'getEstudiantesPorPeriodo'])
        ->name('residentes.por.periodo');
});
Route::get('residentes-export-pdf', [ExportPDFController::class, 'exportResidentes'])
    ->name('residentes.export.pdf');
Route::get('residentes-export-pdf-carrera/{carrera}', [ExportPDFController::class, 'exportResidentesPorCarrera'])
    ->name('residentes.export.pdf.carrera');

//Formatos
Route::get('formato-solicitud-residencia/{estudianteId}', SolicitudResidencia::class)
    ->name('formato.solicitud.residencia');
Route::get('formato-asignacion-residencia/{estudianteId}', AsignacionAsesor::class)
    ->name('formato.asignacion.residencia');
Route::get('formato-carta-presentacion/{estudianteId}', CartaPresentacion::class)
    ->name('formato.carta.presentacion');
Route::get('formato-dictamen-anteproyecto/{carreraId}', DictamenAnteproyectos::class)
    ->name('formato.dictamen.aneproyecto');
Route::get('formato-publicacion-resultados/{carreraId}', PublicacionResultados::class)
    ->name('formato.publicacion.resultados');
Route::get('formato-informe-semestral/{estudianteId}', InformeSemestral::class)
    ->name('formato.informe.semestral');
Route::get('formato-registro-asesoria/{estudianteId}', RegistroAsesoria::class)
    ->name('formato.registro.asesoria');
