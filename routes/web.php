<?php

use App\Mail\BirthdayMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard');


Route::get('/login2', function () {
    return view('auth.login2');
});




/**
 * RUTAS DE AUTENTICACIÓN
 */
Auth::routes();


//RUTAS USUARIO
Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/select2', 'UserController@indexSelect2');
Route::get('/usuario/sesion', 'UserController@validarSesion');
Route::get('/usuario', 'UserController@show');
Route::post('/usuario/store', 'UserController@store');
Route::post('/usuario/update', 'UserController@update');
Route::post('/usuario/update_all', 'UserController@updateAll');
Route::post('/usuario/image_profile', 'UserController@updateImageProfile');
Route::post('/usuario/update/estado', 'UserController@updateEstado');


//RUTAS EMPLEADO
Route::get('/empleados', 'EmpleadoController@index');
Route::get('/empleados/select2', 'EmpleadoController@indexSelect2');
Route::post('/empleado/update', 'EmpleadoController@update');
Route::post('/empleado/update/estado', 'EmpleadoController@updateEstado');
Route::post('/empleado/store', 'EmpleadoController@store');
Route::get('/empleados/jefes_enfermeria', 'EmpleadoController@jefesEnfermeria');


//RUTAS ROLES
Route::get('/roles', 'RoleController@index');
Route::get('/roles/select2', 'RoleController@indexSelect2');
Route::post('/role/store', 'RoleController@store');
Route::post('/role/update', 'RoleController@update');
Route::post('/role/update/estado', 'RoleController@updateEstado');


//RUTAS PERMISOS
Route::get('/permisos', 'PermisoController@index');
Route::get('/permisos/select2', 'PermisoController@indexSelect2');
Route::post('/permiso/store', 'PermisoController@store');
Route::post('/permiso/update', 'PermisoController@update');
Route::post('/permiso/update/estado', 'PermisoController@updateEstado');


//RUTAS ACCIONES
Route::get('/acciones', 'AccionController@index');
Route::get('/acciones/modulos', 'AccionController@groupByModulos');
Route::get('/acciones/modulo/usuarios', 'AccionController@usuariosPorModulo');
Route::get('/acciones/modulo/registros_por_usuario', 'AccionController@registrosPorUsuario');


//RUTAS SESIONES
Route::get('/sesiones', 'SesionController@index');


/*
* RUTAS GESTOR DE PERMISOS
*/
Route::namespace('GestorPermisos')->group(base_path('routes/modulos/gestor_permisos.php'));
Route::namespace('EntesControl')->group(base_path('routes/modulos/entes_control.php'));


//RUTA COMODIN (*)
Route::get('{path}', 'DashboardController@index')->where('path', '([A-z0-9\-\/\_\.\=Ññ]+)?');
