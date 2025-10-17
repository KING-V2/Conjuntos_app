<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    // Ruta para cerrar sesión y revocar tokens
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    
    // Route::get('/getEncuesta', [App\Http\Controllers\EncuestasController::class, 'getEncuesta'])->name('getEncuesta');

    //lista zonas comunes
    
    Route::post('/listarCorrespondencia', [App\Http\Controllers\CorrespondenciaController::class, 'listarCorrespondencia'])->name('listarCorrespondencia');
    
    //encuestas
    Route::post('/respuestaEncuesta', [App\Http\Controllers\EncuestasRespuestasController::class, 'respuestaEncuesta'])->name('respuestaEncuesta');
    
    //foros
    Route::get('/getForo', [App\Http\Controllers\ForoController::class, 'getForo'])->name('getForo');
    Route::post('/respuestaForo', [App\Http\Controllers\RespuestaForoController::class, 'respuestaForo'])->name('respuestaForo');
    Route::post('/misRespuestasForo', [App\Http\Controllers\RespuestaForoController::class, 'misRespuestasForo'])->name('misRespuestasForo');
    
    // Route::post('/guardarRespuestaEncuesta', [App\Http\Controllers\EncuestasRespuestasController::class, 'guardarRespuestaEncuesta'])->name('guardarRespuestaEncuesta');
    Route::get('/getEncuestaUsuario/{usuario_id}', [App\Http\Controllers\EncuestasRespuestasController::class, 'getEncuestaUsuario'])->name('getEncuestaUsuario');
    Route::get('/estadisticaEncuestas/{encuesta_id}', [App\Http\Controllers\EncuestasRespuestasController::class, 'estadisticaEncuestas'])->name('estadisticaEncuestas');
    Route::get('/consultarEncuestasActivas/{usuario_id}', [App\Http\Controllers\EncuestasRespuestasController::class, 'consultarEncuestasActivas'])->name('consultarEncuestasActivas');
    Route::get('/estadisticaEncuestasWeb/{encuesta_id}', [App\Http\Controllers\EncuestasRespuestasController::class, 'estadisticaEncuestasWeb'])->name('estadisticaEncuestasWeb');
    
    
    //trasteos
    Route::post('/solicitarTrasteo', [App\Http\Controllers\TrasteosController::class, 'solicitarTrasteo'])->name('solicitarTrasteo');
    Route::get('/listaSolicitudesTrasteos/{user_id}', [App\Http\Controllers\TrasteosController::class, 'listaSolicitudesTrasteos'])->name('listaSolicitudesTrasteos');
    Route::get('/mis_reservas/{usuario_id}', [App\Http\Controllers\ReservaController::class, 'mis_reservas'])->name('mis_reservas');

    Route::post('/solicitar_reserva', [App\Http\Controllers\ReservaController::class, 'solicitar_reserva'])->name('solicitar_reserva');
});

Route::get('/getZonasComunes', [App\Http\Controllers\ZonaComunController::class, 'getZonasComunes'])->name('getZonasComunes');


//correspondencia
Route::post('/sumarElemento', [App\Http\Controllers\CorrespondenciaController::class, 'sumarElemento'])->name('sumarElemento');
Route::post('/restarElemento', [App\Http\Controllers\CorrespondenciaController::class, 'restarElemento'])->name('restarElemento');
Route::post('/reiniciarCorrespondencia', [App\Http\Controllers\CorrespondenciaController::class, 'reiniciarCorrespondencia'])->name('reiniciarCorrespondencia');
Route::get('/correspondenciaCasa/{id}', [App\Http\Controllers\CorrespondenciaController::class, 'correspondenciaCasa'])->name('correspondenciaCasa');



// Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login_mobile', [App\Http\Controllers\AuthController::class, 'login_mobile'])->name('login_mobile');
// Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);


Route::get('/getCircular/{id}', [App\Http\Controllers\CircularesController::class, 'getCircular'])->name('getCircular');
Route::get('/getCircularesPorMes/{mes}', [App\Http\Controllers\CircularesController::class, 'getCircularesPorMes'])->name('getCircularesPorMes');
Route::get('/getCirculares', [App\Http\Controllers\CircularesController::class, 'getCirculares'])->name('getCirculares');


Route::get('/getDirectorio', [App\Http\Controllers\DirectorioController::class, 'getDirectorio'])->name('getDirectorio');

Route::get('/getEmpleados', [App\Http\Controllers\EmpleadoController::class, 'getEmpleados'])->name('getEmpleados');
Route::get('/getEmpleadosByPuesto/{puesto}', [App\Http\Controllers\EmpleadoController::class, 'getEmpleadosByPuesto'])->name('getEmpleadosByPuesto');


Route::get('/getManual', [App\Http\Controllers\ManualController::class, 'getManual'])->name('getManual');

Route::get('/listaParqueaderos', [App\Http\Controllers\ParqueaderoController::class, 'listaParqueaderos'])->name('listaParqueaderos');

Route::get('/getEmprendimientos', [App\Http\Controllers\EmprendimientosController::class, 'getEmprendimientos'])->name('getEmprendimientos');
Route::get('/getGaleriaEmprendimientos/{id}', [App\Http\Controllers\GaleriaEmprendimientosController::class, 'getGaleriaEmprendimientos'])->name('getGaleriaEmprendimientos');


Route::get('/getGaleriaConjunto', [App\Http\Controllers\GaleriaConjuntoController::class, 'getGaleriaConjunto'])->name('getGaleriaConjunto');

Route::get('/getApartamentosPorEstado/{estado}', [App\Http\Controllers\ApartamentoController::class, 'getApartamentosPorEstado'])->name('getApartamentosPorEstado');
Route::get('/apartamentos/{bloque_id}', [App\Http\Controllers\ApartamentoController::class, 'getApartamentos'])->name('getApartamentos');

Route::get('/getClasificadoByEstado/{estado}', [App\Http\Controllers\ClasificadosController::class, 'getClasificadoByEstado'])->name('getClasificadoByEstado');
Route::get('/getClasificado/{id}', [App\Http\Controllers\ClasificadosController::class, 'getClasificado'])->name('getClasificado');
Route::get('/getGaleriaClasificado/{id}', [App\Http\Controllers\ClasificadosController::class, 'getGaleriaClasificado'])->name('getGaleriaClasificado');


Route::get('/listaResidentes', [App\Http\Controllers\ResidenteController::class, 'listaResidentes'])->name('listaResidentes');

Route::post('/registroVisitante', [App\Http\Controllers\VisitanteController::class, 'registroVisitante'])->name('registroVisitante');
Route::post('/salidaVisitante', [App\Http\Controllers\VisitanteController::class, 'salidaVisitante'])->name('salidaVisitante');


Route::get('/informacion_conjunto', [App\Http\Controllers\InformacionConjuntoController::class, 'informacion_conjunto'])->name('informacion_conjunto');
Route::get('/informacion_residente/{id}', [App\Http\Controllers\ResidenteController::class, 'informacion_residente'])->name('informacion_residente');

Route::get('/getBloquesApi', [App\Http\Controllers\BloqueController::class, 'getBloquesApi'])->name('getBloquesApi');

//apis actividades
Route::get('/getActividades/{mes}', [App\Http\Controllers\ActividadesController::class, 'getActividades']);
Route::post('/saveActividades', [App\Http\Controllers\ActividadesController::class, 'saveActividades']);