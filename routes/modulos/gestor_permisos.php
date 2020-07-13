<?php

/*
* RUTAS DEL MODULO GESTOR DE PERMISOS
*/

// SOFTWARE
Route::get('/gesper_softwares', 'GesperSoftwareController@index');
Route::get('/gesper_software/{software}/show', 'GesperSoftwareController@show');
Route::post('/gesper_software/store', 'GesperSoftwareController@store');
Route::put('/gesper_software/{software}', 'GesperSoftwareController@update');

// MODULOS
Route::get('/gesper_modulos', 'GesperModuloController@index');
Route::get('/gesper_modulo/{proceso}/show', 'GesperModuloController@show');
Route::post('/gesper_modulo/store', 'GesperModuloController@store');
Route::put('/gesper_modulo/{proceso}', 'GesperModuloController@update');

// PROCESOS
Route::get('/gesper_procesos', 'GesperProcesoController@index');
Route::get('/gesper_proceso/{software}/show', 'GesperProcesoController@show');
Route::post('/gesper_proceso/store', 'GesperProcesoController@store');
Route::put('/gesper_proceso/{software}', 'GesperProcesoController@update');

// PERMISOS-USUARIOS
Route::get('/gesper_permisos_usuarios', 'GesperPermisosUsuarioController@index');
Route::get('/gesper_permisos_usuario/{usuario}/show', 'GesperPermisosUsuarioController@show');
Route::post('/gesper_permisos_usuario/store', 'GesperPermisosUsuarioController@store');
Route::post('/gesper_permisos_usuario/renovar', 'GesperPermisosUsuarioController@renovar');

Route::post('/gesper_permisos_usuario/validar', 'GesperPermisosUsuarioController@validar');
Route::put('/gesper_permisos_usuario/{software}', 'GesperPermisosUsuarioController@update');
Route::patch('/gesper_permisos_usuario/{permiso}', 'GesperPermisosUsuarioController@permisoAsignado');
Route::delete('/gesper_permisos_usuario/{permiso}', 'GesperPermisosUsuarioController@destroy');
Route::post('/gesper_permisos_usuario/permisos_asignados/notificacion', 'GesperPermisosUsuarioController@notificarPermisos');


// SOLICITUD DE RETIRO
Route::post('/gesper_solicitud_retiro', 'GesperSolicitudesRetiroController@store');
Route::post('/gesper_solicitud_retiro/registrar_baja', 'GesperSolicitudesRetiroController@registrarBaja');
Route::get('/gestor_permisos/solicitud_retiro/{id}/imprimir', 'GesperSolicitudesRetiroController@imprimir');


// VALIDAR PERMISOS DE UN EMPLEADO - JEFE INMEDIATO
Route::get('gestor_permisos/validar_permisos/{empleado}/jefe_inmediato/{jefe}', 'GesperPermisosUsuarioController@rutaValidarPermisos');

// Obterner el listado de empleados a cargo
Route::get('/gesper_permisos_usuario/subalternos', 'GesperPermisosUsuarioController@subalternos');



// ASIGNAR PERMISOS A LOS EMPLEADOS - ADMINISTRADOR
// Obterner el listado de todos los empleados
Route::get('/gesper_permisos_usuario/administrador/colaboradores', 'GesperPermisosUsuarioController@adminColaboradores');
