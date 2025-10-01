<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CircularesController;
use App\Http\Controllers\EmprendimientosController;
use App\Http\Controllers\GaleriaEmprendimientosController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\ConjuntoController;
use App\Http\Controllers\ClasificadosController;
use App\Http\Controllers\ClasificadoGaleriaController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TrasteosController;
use App\Http\Controllers\ParqueaderoController;
use App\Http\Controllers\ZonaComunController;
use App\Http\Controllers\EncuestasController;
use App\Http\Controllers\EncuestasRespuestasController;
use App\Http\Controllers\CorrespondenciaController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\RespuestaForoController;
use App\Http\Controllers\LogUsuariosController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\GaleriaConjuntoController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\InformacionConjuntoController;
use App\Http\Controllers\LogSistemaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\TarifasConjuntoController;
use App\Http\Controllers\ParqueaderoVisitantesController;
use App\Http\Controllers\CategoriaVehiculoController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\CasasController;

use App\Http\Controllers\RegistroParqueaderoController;
use App\Http\Controllers\VehiculoController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth'])->group(function () {
    //     Route::resource('users', UserController::class);
    // });
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Auth::routes();

Route::get('/estadisticaEncuestas/{encuesta_id}', [EncuestasRespuestasController::class, 'estadisticaEncuestas']);
Route::get('/getUsuariosPorRol', [UserController::class, 'getUsuariosPorRol']);
Route::get('/residenteQrInfo/{user_id}/{tipo_residente}/{cod_apartamento}', [ResidenteController::class, 'residenteQrInfo']);

Route::middleware(['auth'])->group(function () {
    
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles_create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles_store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');

    // modulo de permisos
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionsController::class, 'store'])->name('permissions.store');

    // users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users_create', [UserController::class, 'store']);
    Route::get('/users_edit/{id}', [UserController::class, 'edit']);
    Route::post('/users_update', [UserController::class, 'update']);
    Route::get('/users_delete/{id}', [UserController::class, 'destroy']);
    
    //modificacion de mermisos de acceso a apps del sistema
    Route::post('/modificarAccesosUsuario', [UserController::class, 'modificarAccesosUsuario']);


    Route::get('user-roles', [UserRoleController::class, 'index'])->name('user_roles.index');
    Route::get('user-roles/{id}/edit', [UserRoleController::class, 'edit'])->name('user_roles.edit');
    Route::put('user-roles/{id}', [UserRoleController::class, 'update'])->name('user_roles.update');
    
    //circulares
    Route::get('/circulares', [CircularesController::class, 'index']);
    Route::post('/cargar_circulares', [CircularesController::class, 'store']);
    Route::get('/circulares_edit/{id}', [CircularesController::class, 'edit']);
    Route::post('/circulares_update', [CircularesController::class, 'update']);
    Route::get('/circulares_delete/{id}', [CircularesController::class, 'destroy']);

    //emprendimientos
    Route::get('/emprendimientos', [EmprendimientosController::class, 'index']);
    Route::post('/cargar_emprendimiento', [EmprendimientosController::class, 'store']);
    Route::get('/emprendimiento_edit/{id}', [EmprendimientosController::class, 'edit']);
    Route::post('/emprendimiento_update', [EmprendimientosController::class, 'update']);
    Route::get('/emprendimiento_delete/{id}', [EmprendimientosController::class, 'destroy']);

    Route::get('/galeria_emprendimiento/{id}', [GaleriaEmprendimientosController::class, 'index']);
    Route::get('/galeria_emprendimientos', [GaleriaEmprendimientosController::class, 'lista']);
    Route::post('/cargar_galeria_emprendimiento', [GaleriaEmprendimientosController::class, 'create']);
    Route::get('/galeria_emprendimientos_delete/{id}', [GaleriaEmprendimientosController::class, 'destroy']);

    //empleados
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::post('/cargar_empleados', [EmpleadoController::class, 'store']);
    Route::get('/empleados_edit/{id}', [EmpleadoController::class, 'edit']);
    Route::post('/empleados_update', [EmpleadoController::class, 'update']);
    Route::get('/empleados_delete/{id}', [EmpleadoController::class, 'destroy']);

    //directorios
    Route::get('/directorios', [DirectorioController::class, 'index']);
    Route::post('/cargar_directorios', [DirectorioController::class, 'store']);
    Route::get('/directorios_edit/{id}', [DirectorioController::class, 'edit']);
    Route::post('/directorios_update', [DirectorioController::class, 'update']);
    Route::get('/directorios_delete/{id}', [DirectorioController::class, 'destroy']);

    //manuales
    Route::get('/manuales', [ManualController::class, 'index']);
    Route::post('/cargar_manuales', [ManualController::class, 'create']);
    Route::get('/manuales_edit/{id}', [ManualController::class, 'edit']);
    Route::post('/manuales_update', [ManualController::class, 'update']);
    Route::get('/manuales_delete/{id}', [ManualController::class, 'destroy']);


    //apartamentos
    Route::get('/apartamentos', [ApartamentoController::class, 'index']);
    Route::post('/cargar_apartamentos', [ApartamentoController::class, 'store']);
    Route::get('/apartamentos_edit/{id}', [ApartamentoController::class, 'edit']);
    Route::post('/apartamentos_update', [ApartamentoController::class, 'update']);
    Route::get('/apartamentos_delete/{id}', [ApartamentoController::class, 'destroy']);
    Route::get('/get-apartamentos/{bloque_id}', [ApartamentoController::class, 'getApartamentos']);

    //bloques
    Route::get('/bloques', [BloqueController::class, 'index']);
    Route::post('/cargar_bloques', [BloqueController::class, 'store']);
    Route::get('/bloques_edit/{id}', [BloqueController::class, 'edit']);
    Route::post('/bloques_update', [BloqueController::class, 'update']);
    Route::get('/bloques_delete/{id}', [BloqueController::class, 'destroy']);
    Route::get('/get-bloques/{conjunto_id}', [BloqueController::class, 'getBloques']);

    //conjuntos
    Route::get('/conjuntos', [ConjuntoController::class, 'index']);
    Route::post('/cargar_conjuntos', [ConjuntoController::class, 'store']);
    Route::get('/conjuntos_edit/{id}', [ConjuntoController::class, 'edit']);
    Route::post('/conjuntos_update', [ConjuntoController::class, 'update']);
    Route::get('/conjuntos_delete/{id}', [ConjuntoController::class, 'destroy']);

    //seccion de informacion de conjunto
    // Route::resource('informacion_conjunto', InformacionConjuntoController::class);
    Route::get('/informacion_conjunto', [InformacionConjuntoController::class, 'index'])->name('informacion_conjunto.index');
    Route::get('/informacion_conjunto_create', [InformacionConjuntoController::class, 'create'])->name('informacion_conjunto.create');
    Route::post('/informacion_conjunto_store', [InformacionConjuntoController::class, 'store'])->name('informacion_conjunto.store');
    Route::get('/informacion_conjunto/{id}/edit', [InformacionConjuntoController::class, 'edit'])->name('informacion_conjunto.edit');
    Route::post('/informacion_conjunto_update', [InformacionConjuntoController::class, 'update'])->name('informacion_conjunto.update');
    Route::get('/informacion_conjunto_delete/{id}', [InformacionConjuntoController::class, 'destroy'])->name('informacion_conjunto.destroy');


    //clasificados
    Route::get('/clasificados', [ClasificadosController::class, 'index']);
    Route::post('/cargar_clasificados', [ClasificadosController::class, 'store']);
    Route::get('/clasificados_edit/{id}', [ClasificadosController::class, 'edit']);
    Route::post('/clasificados_update', [ClasificadosController::class, 'update']);
    Route::get('/clasificados_delete/{id}', [ClasificadosController::class, 'destroy']);

    //clasificado_galeria
    Route::get('/clasificado_galeria', [ClasificadoGaleriaController::class, 'index']);
    Route::get('/galeria_de_clasificado/{id}', [ClasificadoGaleriaController::class, 'show']);
    Route::post('/cargar_clasificado_galeria', [ClasificadoGaleriaController::class, 'store']);
    Route::get('/clasificado_galeria_edit/{id}', [ClasificadoGaleriaController::class, 'edit']);
    Route::get('/clasificado_galeria_delete/{id}', [ClasificadoGaleriaController::class, 'destroy']);

    //residentes
    Route::get('/residentes', [ResidenteController::class, 'index']);
    Route::post('/cargar_residentes', [ResidenteController::class, 'store']);
    Route::get('/residentes_edit/{id}', [ResidenteController::class, 'edit'])->name('residentes.edit');
    Route::post('/residentes_update', [ResidenteController::class, 'update']);
    Route::get('/residentes_delete/{id}', [ResidenteController::class, 'destroy'])->name('residentes.delete'); 
    Route::get('/searchResidenteJson', [ResidenteController::class, 'searchResidenteJson'])->name('searchResidenteJson');
    
    //registro de residente desde vista de bloques
    Route::post('/registrarResidente', [ResidenteController::class, 'registrarResidente']);


    //reservas
    Route::get('/reservas', [ReservaController::class, 'index']);
    Route::post('/cargar_reservas', [ReservaController::class, 'store']);
    Route::get('/reservas_edit/{id}', [ReservaController::class, 'edit']);
    Route::post('/reservas_update', [ReservaController::class, 'update']);
    Route::get('/reservas_delete/{id}', [ReservaController::class, 'destroy']);


    //trasteos
    Route::get('/trasteos', [TrasteosController::class, 'index']);
    Route::post('/cargar_trasteos', [TrasteosController::class, 'store']);
    Route::get('/trasteos_edit/{id}', [TrasteosController::class, 'edit']);
    Route::post('/trasteos_update', [TrasteosController::class, 'update']);
    Route::get('/trasteos_delete/{id}', [TrasteosController::class, 'destroy']);

    //parqueaderos
    Route::get('/parqueaderos', [ParqueaderoController::class, 'index']);
    Route::post('/cargar_parqueaderos', [ParqueaderoController::class, 'store']);
    Route::get('/parqueaderos_edit/{id}', [ParqueaderoController::class, 'edit']);
    Route::post('/parqueaderos_update', [ParqueaderoController::class, 'update']);
    Route::get('/parqueaderos_delete/{id}', [ParqueaderoController::class, 'destroy']);

    //registro_parqueaderos
    Route::get('/registro_parqueaderos', [RegistroParqueaderoController::class, 'index']);
    Route::post('/cargar_registro_parqueaderos', [RegistroParqueaderoController::class, 'store']);
    Route::get('/registro_parqueaderos_edit/{id}', [RegistroParqueaderoController::class, 'edit']);
    Route::post('/registro_parqueaderos_update', [RegistroParqueaderoController::class, 'update']);
    Route::get('/registro_parqueaderos_delete/{id}', [RegistroParqueaderoController::class, 'destroy']);
    
    //vehiculos
    Route::get('/vehiculos', [VehiculoController::class, 'index']);
    Route::post('/cargar_vehiculos', [VehiculoController::class, 'store']);
    Route::get('/vehiculos_edit/{id}', [VehiculoController::class, 'edit']);
    Route::post('/vehiculos_update', [VehiculoController::class, 'update']);
    Route::get('/vehiculos_delete/{id}', [VehiculoController::class, 'destroy']);


    //zonas_comunes
    Route::get('/zonas_comunes', [ZonaComunController::class, 'index']);
    Route::post('/cargar_zonas_comunes', [ZonaComunController::class, 'store']);
    Route::get('/zonas_comunes_edit/{id}', [ZonaComunController::class, 'edit']);
    Route::post('/zonas_comunes_update', [ZonaComunController::class, 'update']);
    Route::get('/zonas_comunes_delete/{id}', [ZonaComunController::class, 'destroy']);

    //encuestas
    Route::get('/encuestas', [EncuestasController::class, 'index']);
    Route::post('/cargar_encuestas', [EncuestasController::class, 'store']);
    Route::get('/encuestas_edit/{id}', [EncuestasController::class, 'edit']);
    Route::post('/encuestas_update', [EncuestasController::class, 'update']);
    Route::get('/encuestas_delete/{id}', [EncuestasController::class, 'destroy']);

    //encuestas_respuestas
    Route::get('/encuestas_respuestas', [EncuestasRespuestasController::class, 'index']);
    Route::post('/cargar_encuestas_respuestas', [EncuestasRespuestasController::class, 'store']);
    Route::get('/encuestas_respuestas_edit/{id}', [EncuestasRespuestasController::class, 'edit']);
    Route::post('/encuestas_respuestas_update', [EncuestasRespuestasController::class, 'update']);
    Route::get('/encuestas_respuestas_delete/{id}', [EncuestasRespuestasController::class, 'destroy']);

    //correspondencia
    Route::get('/correspondencia', [CorrespondenciaController::class, 'index']);
    Route::post('/cargar_correspondencia', [CorrespondenciaController::class, 'store']);
    Route::get('/correspondencia_edit/{id}', [CorrespondenciaController::class, 'edit']);
    Route::post('/correspondencia_update', [CorrespondenciaController::class, 'update']);
    Route::get('/correspondencia_delete/{id}', [CorrespondenciaController::class, 'destroy']);

    Route::post('/recepcionServiciosConjuntos', [CorrespondenciaController::class, 'recepcionServiciosConjuntos']);
    

    //botones para el aumento o disminucion de un item de la correspondencia
    Route::post('/sumarElemento', [CorrespondenciaController::class, 'sumarElemento']);
    Route::post('/restarElemento', [CorrespondenciaController::class, 'restarElemento']);
    Route::post('/reiniciarCorrespondencia', [CorrespondenciaController::class, 'reiniciarCorrespondencia']);
    //botones para el reinicio de los recibos de servicios publicos

    //foros
    Route::get('/foros', [ForoController::class, 'index']);
    Route::post('/cargar_foros', [ForoController::class, 'store']);
    Route::get('/foros_edit/{id}', [ForoController::class, 'edit']);
    Route::post('/foros_update', [ForoController::class, 'update']);
    Route::get('/foros_delete/{id}', [ForoController::class, 'destroy']);

    //respuesta_foros
    Route::get('/respuesta_foros', [RespuestaForoController::class, 'index']);
    Route::post('/cargar_respuesta_foros', [RespuestaForoController::class, 'store']);
    Route::get('/respuesta_foros_edit/{id}', [RespuestaForoController::class, 'edit']);
    Route::post('/respuesta_foros_update', [RespuestaForoController::class, 'update']);
    Route::get('/respuesta_foros_delete/{id}', [RespuestaForoController::class, 'destroy']);
    
    //galeria_emprendimiento
    Route::get('/cargar_galeria', [GaleriaEmprendimientosController::class, 'create']);
    Route::get('/galeria_emprendimiento/{id}', [GaleriaEmprendimientosController::class, 'index']);
    Route::get('/galeria_emprendimiento_delete/{id}', [GaleriaEmprendimientosController::class, 'destroy']);

    //galeria_conjunto
    Route::get('/galeria_conjunto', [GaleriaConjuntoController::class, 'index']);
    Route::post('/cargar_galeria_conjunto', [GaleriaConjuntoController::class, 'store']);
    Route::get('/galeria_conjunto_edit/{id}', [GaleriaConjuntoController::class, 'edit']);
    Route::post('/galeria_conjunto_update', [GaleriaConjuntoController::class, 'update']);
    Route::get('/galeria_conjunto_delete/{id}', [GaleriaConjuntoController::class, 'destroy']);
    
    //galeria_conjunto
    Route::get('/tarifas_conjunto', [TarifasConjuntoController::class, 'index']);
    Route::post('/cargar_tarifas_conjunto', [TarifasConjuntoController::class, 'store']);
    Route::get('/tarifas_conjunto_edit/{id}', [TarifasConjuntoController::class, 'edit']);
    Route::post('/tarifas_conjunto_update', [TarifasConjuntoController::class, 'update']);
    Route::get('/tarifas_conjunto_delete/{id}', [TarifasConjuntoController::class, 'destroy']);
   
    //parqueadero visitantes
    Route::get('/parqueadero_visitante', [ParqueaderoVisitantesController::class, 'index']);
    Route::post('/cargar_parqueadero_visitante', [ParqueaderoVisitantesController::class, 'store']);
    Route::get('/parqueadero_visitante_edit/{id}', [ParqueaderoVisitantesController::class, 'edit']);
    Route::post('/parqueadero_visitante_update', [ParqueaderoVisitantesController::class, 'update']);
    Route::get('/parqueadero_visitante_delete/{id}', [ParqueaderoVisitantesController::class, 'destroy']);
    
    
    //categoria_vehiculos
    Route::get('/categoria_vehiculo', [CategoriaVehiculoController::class, 'index']);
    Route::post('/cargar_categoria_vehiculo', [CategoriaVehiculoController::class, 'store']);
    Route::get('/categoria_vehiculo_edit/{id}', [CategoriaVehiculoController::class, 'edit']);
    Route::post('/categoria_vehiculo_update', [CategoriaVehiculoController::class, 'update']);
    Route::post('/categoria_vehiculo_delete', [CategoriaVehiculoController::class, 'destroy']);
    
    Route::get('/registroSalidaVehiculo/{id}', [ParqueaderoVisitantesController::class, 'registroSalidaVehiculo']);
    Route::get('/recibo_parqueadero/{id}', [ParqueaderoVisitantesController::class, 'factura'])->name('recibo_parqueadero');
    // Route::get('/recibo_parqueadero/{id}', [TuControlador::class, 'mostrarRecibo'])->name('recibo_parqueadero');


    //log_usuarios
    Route::get('/log_usuarios', [LogUsuariosController::class, 'index']);
    Route::get('/log_sistema', [LogSistemaController::class, 'index']);

    //visitantes
    Route::get('/visitantes', [VisitanteController::class, 'index']);
    Route::post('/cargar_visitantes', [VisitanteController::class, 'store']);
    Route::get('/visitantes_edit/{id}', [VisitanteController::class, 'edit']);
    Route::post('/visitantes_update', [VisitanteController::class, 'update']);
    Route::get('/visitantes_delete/{id}', [VisitanteController::class, 'destroy']);
    Route::get('/registroSalidaVisitante/{id}', [VisitanteController::class, 'registroSalidaVisitante']);

    Route::get('/actividades', [ActividadesController::class, 'index']);
    Route::post('/cargar_actividades', [ActividadesController::class, 'store']);
    Route::get('/actividades_edit/{id}', [ActividadesController::class, 'edit']);
    Route::post('/actividades_update', [ActividadesController::class, 'update']);
    Route::get('/actividades_delete/{id}', [ActividadesController::class, 'destroy']);

    Route::get('/casas', [CasasController::class, 'index']);
    Route::get('/citofonia', [CasasController::class, 'showall']);
    Route::post('/cargar_casas', [CasasController::class, 'store']);
    Route::get('/casas_edit/{id}', [CasasController::class, 'edit']);
    Route::post('/casas_update', [CasasController::class, 'update']);
    Route::get('/casas_delete/{id}', [CasasController::class, 'destroy']);

    Route::get('/correspondenciallenar/{cantidad}', [CorrespondenciaController::class, 'correspondenciallenar']);
    Route::get('/casasllenar/{cantidad}', [CorrespondenciaController::class, 'casasllenar']);


});

