<?php

/*
* RUTAS DEL MODULO GESTOR DE PERMISOS
*/

// SOFTWARE
Route::get('/entes_control/informes', 'InformeController@index');
Route::post('/entes_control/crear_informe', 'InformeController@crearInforme');
Route::get('/entes_control/get_informes', 'InformeController@getInformes');


Route::get('/entes_control/dependencias', 'DependenciaController@index');
Route::post('/entes_control/crear_dependencia', 'DependenciaController@crearDependencia');
Route::post('/entes_control/editar_dependencia', 'DependenciaController@editarDependencia');

Route::get('/entes_control/entes', 'EnteController@index');
Route::post('/entes_control/crear_ente', 'EnteController@store');
Route::post('/entes_control/editar_ente', 'EnteController@edit');


