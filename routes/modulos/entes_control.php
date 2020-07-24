<?php

/*
* RUTAS DEL MODULO GESTOR DE PERMISOS
*/

// SOFTWARE
Route::get('/entes_control/informes', 'InformeController@index');
Route::post('/entes_control/crear_informe', 'InformeController@crearInforme');
Route::get('/entes_control/get_informes', 'InformeController@getInformes');
Route::post('/entes_control/anexar_evidencias', 'InformeController@anexarEvidencias');
Route::post('/entes_control/get_evidencias', 'InformeController@getEvidenciasById');
Route::post('/entes_control/set_status_informe', 'InformeController@setEstadoInforme');
Route::post('/entes_control/get_informes_dependencia', 'InformeController@getInformesByDependencia');


Route::get('/entes_control/dependencias', 'DependenciaController@index');
Route::post('/entes_control/crear_dependencia', 'DependenciaController@crearDependencia');
Route::post('/entes_control/editar_dependencia', 'DependenciaController@editarDependencia');

Route::get('/entes_control/entes', 'EnteController@index');
Route::post('/entes_control/crear_ente', 'EnteController@store');
Route::post('/entes_control/editar_ente', 'EnteController@edit');


