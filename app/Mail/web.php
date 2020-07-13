<?php

use App\Mail\BirthdayMail;
use App\Exports\PruebaExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;

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


Route::get('/password/reset/{hash}', 'Auth\LoginController@showLoginForm')->where('path', '([A-z\d-\/_\.]+)?');


Auth::routes();



//RUTAS PASSWORD RESET
Route::post('/password/reset/email', 'Auth\ResetPasswordController@getEmailPasswordReset');


//RUTAS USUARIO
Route::get('/usuarios', 'UserController@index');
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


//RUTAS PACIENTES
Route::post('/paciente/show', 'PacienteController@show');
Route::post('/paciente/store', 'PacienteController@store');
Route::post('/paciente/update', 'PacienteController@update');


//RUTAS PAGADORES
Route::post('/pagadores', 'PagadorController@index');


//RUTAS CODIGOS CIE10

Route::get('/codigoscie10', 'CodigoCie10Controller@index');


//RUTAS SERVICIOS

Route::post('/servicios', 'ServiciosHuemController@index');


//RUTAS CAMAS

Route::post('/camas', 'CamaController@index');


//RUTAS CODIGOS CUPS

Route::get('/codigoscups', 'CodigosCupsController@index');


//RUTAS CODIGOS SOAT

Route::get('/codigos_soat', 'CodigoSoatController@index');



//RUTAS TIPOS DE SERVICIOS SOLICITADOS

Route::post('/tipos_servicios_solicitados', 'TipoServicioSolicitadoController@index');


//RUTAS REFERENCIA
Route::get('/referencias', 'ReferenciaController@index');
Route::post('/referencia/store', 'ReferenciaController@store');
Route::get('/referencia', 'ReferenciaController@show');
Route::post('/referencia/update_cama', 'ReferenciaController@updateCama');
Route::post('/referencia/cita_medica', 'ReferenciaController@updateCitaMedica');
Route::post('/referencia/cerrar', 'ReferenciaController@cerrarReferencia');
Route::get('/referencia/estados', 'ReferenciaController@estadosReferencias');

Route::get('/referencia/dinamica/cama', 'ReferenciaController@getCamaOfDinamica');

//RUTAS REFERENCIA REPORTES 
Route::get('/referencia/reporte/abiertas', 'ReferenciaController@ReferenciasAbiertasExport');
Route::get('/referencia/reporte/excel/{desde}/{hasta}/{estado}/download', 'ReferenciaController@ReferenciasExportExcel');



//RUTAS TRAZABILIDADES
Route::post('/trazabilidad/store', 'TrazabilidadController@store');


//RUTAS IPS RECEPTORAS
Route::get('/ips_receptoras', 'IpsReceptoraController@index');



//RUTAS CIRUGIAS
Route::get('/cirugias', 'CirugiaController@index');
Route::post('/cirugia/store', 'CirugiaController@store');

//RUTAS CIRUGIAS REPORTES 
Route::get('/cirugia/{id}/download/pdf', 'CirugiaController@downloadPDF');
Route::get('/cirugia/reporte/excel/{desde}/{hasta}/{usuarios}/download', 'CirugiaController@CirugiasExportExcel');



/**
 * RUTAS SEGUIMIENTO POST EGRESOS
 */

//RUTAS SEGUIMIENTO DE EGRESOS
Route::get('/egreso_pacientes', 'EgresoPacienteController@index');
Route::get('/egreso_pacientes/servicios', 'EgresoPacienteController@listadoServicios');
Route::get('/egreso_pacientes/estados', 'EgresoPacienteController@estadosEgresos');
Route::post('/egresos/spe_primer_seguimiento/store', 'SpePrimerSeguimientoController@store'); 
Route::post('/egresos/spe_segundo_seguimiento/store', 'SpeSegundoSeguimientoController@store');

// RUTAS SEGUIMIENTO DE EGRESOS - REPORTES
Route::get('/seguimiento_egresos/reporte/excel/{desde}/{hasta}/{estado}/download', 'EgresoPacienteController@EgresoPacientesExportExcel');

Route::get('/egreso_pacientes/informe_global', 'EgresoPacienteController@informeGlobal');

Route::get('/egreso_pacientes/informes/ips_remitidas', 'EgresoPacienteController@ipsRemitidad');
Route::get('/egreso_pacientes/total_egresos', 'EgresoPacienteController@totalEgresos');
Route::get('/egreso_pacientes/informes/autorizacion', 'EgresoPacienteController@autorizacionCuestionario');
Route::get('/egreso_pacientes/informes/recuperacion', 'EgresoPacienteController@recuperacionSatisfactoria');
Route::get('/egreso_pacientes/informes/recomendaciones', 'EgresoPacienteController@recomendacionesClaras');
Route::get('/egreso_pacientes/informes/medicamentos', 'EgresoPacienteController@medicamentosSuministrar');
Route::get('/egreso_pacientes/informes/control_especialista', 'EgresoPacienteController@controlEspecialista');



/*
* RUTAS CIRUGÍAS AMBULATORIAS
*/
Route::get('/seguimiento_cirugias_ambulatorias', 'ScaCirugiasAmbulatoriaController@index');
Route::post('/seguimiento_cirugias_ambulatorias/store', 'ScaCirugiasAmbulatoriaController@store');
Route::post('/seguimiento_cirugias_ambulatorias/show', 'ScaCirugiasAmbulatoriaController@show');
Route::post('/seguimiento_cirugias_ambulatorias/update', 'ScaCirugiasAmbulatoriaController@update');
Route::post('/seguimiento_cirugias_ambulatorias/delete', 'ScaCirugiasAmbulatoriaController@delete');
Route::post('/seguimiento_cirugias_ambulatorias/dinamica/show', 'ScaCirugiasAmbulatoriaController@dinamicaShow'); 
Route::get('/seguimiento_cirugias_ambulatorias/estados', 'ScaCirugiasAmbulatoriaController@estadosEgresos');

// RUTAS SEGUIMIENTOS POST-OPERATORIO
Route::post('/seguimiento_cirugias_ambulatorias/spo_seguimientos/store', 'ScaSeguimientoController@store'); 

// RUTAS REPORTES
Route::get('/seguimiento_cirugias_ambulatorias/reporte/excel/{desde}/{hasta}/{estado}/download', 'ScaCirugiasAmbulatoriaController@EgresosAmbulatorioExportExcel');
Route::get('/seguimiento_cirugias_ambulatorias/informe_global', 'ScaCirugiasAmbulatoriaController@informeGlobal');



/*
* RUTAS ACREDITACION
*/

//RUTAS PDM PROCESOS
Route::get('/pdm_procesos', 'PdmProcesoController@index');
Route::post('/pdm_proceso/show', 'PdmProcesoController@show');

//RUTAS PDM AREAS
Route::get('/pdm_areas', 'PdmAreaController@index');

//RUTAS USUARIOS-ACREDITACION
Route::get('/pdm_usuarios', 'UserController@showAcreditacion');

//RUTAS PDM FUENTES HALLAZGOS
Route::get('/pdm_fuentes_hallazgos', 'PdmFuenteHallazgoController@index');

//RUTAS PLANES DE MEJORAMIENTO
Route::get('/planes_mejoramiento', 'PlanesMejoramientoController@index');
Route::post('/planes_mejoramiento/store', 'PlanesMejoramientoController@store');
Route::post('/planes_mejoramiento/show', 'PlanesMejoramientoController@show');
Route::post('/planes_mejoramiento/update', 'PlanesMejoramientoController@update');
Route::get('/planes_mejoramiento/reporte/excel', 'PlanesMejoramientoController@PlanesMejoramientoExportExcel');
Route::get('/planes_mejoramiento/estados_ejecucion', 'PlanesMejoramientoController@estadoPlanesDeMejoramiento');

//RUTAS SEGUIMIENTOS
Route::post('/pdm_seguimiento/store', 'PdmSeguimientoController@store');



/*
* RUTAS CONTRAREFERENCIA
*/
Route::get('/contrarreferencias', 'ContrarreferenciaController@index');
Route::post('/contrarreferencia/store', 'ContrarreferenciaController@store');

//RUTAS ACEPTACION / NEGACION
Route::post('/cref_aceptacion_negacion/store', 'CrefAceptacionNegacionController@store');

//RUTAS DEPARTAMETO
Route::get('/departamentos', 'DepartamentoController@index');

//RUTAS MUNICIPIO
Route::get('/municipios', 'MunicipioController@index');

//RUTAS PROFESIONALES RESPONSABLES
Route::get('/cref_profesionales_responsables', 'CrefProfesionalResponsableController@index');
Route::get('/cref_profesionales_responsables/load', 'CrefProfesionalResponsableController@load');



//RUTAS CUMPLEAÑOS
Route::get('/cumple_colaboradores', 'CumpleColaboradorController@index');
Route::get('/cumple_colaborador', 'CumpleColaboradorController@show');
Route::post('/cumple_colaborador/store', 'CumpleColaboradorController@store');
Route::post('/cumple_colaborador/update', 'CumpleColaboradorController@update');
Route::post('/cumple_colaborador/update/estado', 'CumpleColaboradorController@updateEstado');



/*
* RUTAS BIOMEDICINA
*/

//RUTAS BIOM EQUIPOS
Route::get('/biom_equipos', 'BiomEquipoController@index');
Route::get('/biom_equipo/show', 'BiomEquipoController@show');
Route::post('/biom_equipo/store', 'BiomEquipoController@store');
Route::post('/biom_equipo/update', 'BiomEquipoController@update');

Route::get('/biom_equipos/select2', 'BiomEquipoController@select2');
Route::post('/biom_equipo/saveImage', 'BiomEquipoController@saveImage');

Route::post('/biom_equipo/update/estado', 'BiomEquipoController@updateEstado');

Route::get('/biomedicina/equipos/reporte/excel', 'BiomEquipoController@BiomEquiposExportExcel');

//RUTAS BIOM NOMBRES DE EQUIPOS MEDICOS
Route::get('biom_nombres_equipos', 'BiomNombresEquipoController@index');

//RUTAS BIOM SERVICIOS
Route::get('/biom_servicios', 'BiomServicioController@index');

//RUTAS BIOM AMBIENTES
Route::get('/biom_ambientes', 'BiomAmbienteController@index');

//RUTAS CRONOGRAMA MANTENIMIENTOS
Route::post('/biom_cronograma_mantenimientos', 'BiomCronogramaMantenimientoController@index');
Route::post('/biom_cronograma_mantenimientos/store', 'BiomCronogramaMantenimientoController@store');
Route::patch('/biom_cronograma_mantenimientos', 'BiomCronogramaMantenimientoController@update');
Route::delete('/biom_cronograma_mantenimientos', 'BiomCronogramaMantenimientoController@destroy');



/*
* RUTAS INDICADORES
*/
Route::post('/indicador/store', 'IndicadorController@store');
Route::post('/indicador/update', 'IndicadorController@update');

Route::get('/indi_ficha_tecnica', 'IndiFichaTecnicaController@index');
Route::get('/indi_ficha_tecnica/show', 'IndiFichaTecnicaController@show');


/*
* RUTAS DE PRUEBAS
*/

// RUTA DE PRUEBAS
Route::get('/sql_egresos', function(){
    //phpinfo(); 
    //exit();

    // EXEC sp_prueba @id="1";
    $last_id = 472788;
    $data    = DB::connection('sql_dg02')->select('EXEC sp_egresos_dinamica @ID='. $last_id .'');

    return json_encode($data);
});



// RUTA DE PRUEBAS DGH
Route::get('/pruebas_dgh', function(){
    $response = ['registrados' => 0, 'actualizados' => 0];

    $id = App\Models\EgresoPaciente::max('dinamica_id');
    $id = $id < 468396 ? 468396 : $id;

    $datos = DB::connection('sql_dg02')->select('Exec sp_egresos_dinamica @ID='. $id .'');

    foreach ($datos as $egreso) {
        $old_egreso = App\Models\EgresoPaciente::where('dinamica_id', $egreso->dinamica_id)->first();

        if( $old_egreso ) {
            $old_egreso->egreso_diagnostico = $old_egreso->egreso_diagnostico .','. $egreso->egreso_diagnostico;
            $old_egreso->save();

            $response['actualizados'] += 1;
        }
        else {
            $new_egreso = new App\Models\EgresoPaciente();
            $new_egreso->dinamica_id = $egreso->dinamica_id;

            $new_egreso->paciente_documento = $egreso->paciente_documento;
            $new_egreso->paciente_tipo_documento = $egreso->paciente_tipo_documento;
            $new_egreso->paciente_nombre = $egreso->paciente_nombre;
            $new_egreso->paciente_telefono = $egreso->paciente_telefono;
            $new_egreso->paciente_direccion = $egreso->paciente_direccion;
            $new_egreso->paciente_erp = $egreso->paciente_erp;

            $new_egreso->egreso_fecha = $egreso->egreso_fecha;
            $new_egreso->egreso_servicio = $egreso->egreso_servicio;
            $new_egreso->egreso_diagnostico = $egreso->egreso_diagnostico;

            $new_egreso->procedimiento_solicitado = $egreso->procedimiento_solicitado;
            $new_egreso->save();

            $response['registrados'] += 1;
        }
    }

    return 'Total de registros realizados: '. $response['registrados'] 
    .' - Total de registros actualizados: '. $response['actualizados'] 
    .' - Total: '. intval($response['registrados'] + $response['actualizados']) .'';
    //return json_encode($datos);
});



// PRUEBA CONSULTA PACIENTE DGH
Route::get('/paciente_dg', function(){
    $last_id = '60509';
    $data = DB::connection('sql_dg02')->select(
        DB::raw("SELECT PACTIPDOC AS tipo_documento, PACNUMDOC AS documento, 
        (PACPRINOM + ' ' + PACSEGNOM) AS nombres, (PACPRIAPE + ' ' + PACSEGAPE) AS apellidos, 
        GPAFECNAC AS fecha_nacimiento, GPASEXPAC AS genero
        FROM GENPACIEN
        WHERE PACNUMDOC = '$last_id'
        ORDER BY OID DESC")
    );

    $data[0]->NOMBRES = 'PRUEBAS';
    $data = $data[0];

    return json_encode($data);
});


// AGREGAR PROCEDIMIENTO
Route::get('/add_cups', function(){

    $cups = new \App\Models\CodigosCups();
    $cups->codigo = '363201';
    $cups->procedimiento = 'REINTERVENCION DE REVASCULARIZACION CARDIACA (DERIVACION O PUENTES CORONARIOS) VIA ABIERTA';
    $cups->sexo = 'A';
    $cups->edad_ini = '0';
    $cups->edad_fin = '599';
    $cups->archivo = 'AP';
    $cups->qx = '0';
    $cups->tipo_procedimiento = '';
    $cups->no_minimo = '4';
    $cups->no_maximo = '4';
    $cups->finalidad = '1';
    $cups->save();

    return 'El id #'. $cups->id .': codigo cups '. $cups->codigo .' - '. $cups->procedimiento .' - Se registro exitosamente.';
});


Route::get('/sendmail', function(){
    $bts = [];
    $css = App\Models\BootstrapCss::all();

    foreach($css as $data)
    {
        $bts[$data->clase] = $data->estilos;
    }

    /*Illuminate\Support\Facades\Mail::send('emails.prueba', [], function ($m) {
        $m->from('soporte@edtlsoft.com', 'Your Application');

        $m->to('edwardlopez.huem@gmail.com', 'Edward Lopez')->subject('Your Reminder!');
    });*/

    return view('emails.prueba', ['bts' => $bts]);
});


Route::get('text_image', function(){
    $image = \imagecreatefrompng( \storage_path('app/public/email/php_image.png') );

    $white_color = \imagecolorallocate($image, 255, 255, 255);

    $font = \storage_path('app/public/email/Highest.ttf');

    $text = "Welcome To Talkerscode";

    $size  = 50;
    $angle = 90;
    $left  = 125;
    $top   = 250;

    // Print Text On Image
    \imagettftext($image, $size,$angle,$left,$top, $white_color, $font, $text);

    // Send Image to Browser
    \imagejpeg($image, \storage_path('app/public/email/php_text_90.png'));

    // Clear Memory
    \imagedestroy($image);
});


Route::get('execute_sh', function(){
    $data = '';

    //exec('"C:/Program Files/Git/bin/bash.exe" "C:/wamp64/www/huem/huem_soft/cron/dinamica/import_egresos_dinamica.sh"', $data);
    exec('bash ', $data);

    //$data = [1,2,3];

    var_dump($data);
});


Route::get('id_sesion', function(){
    $desde = '2019-05-01 00:00:00';
    $hasta = '2019-05-14 23:59:59';

    $ips_remitidas = DB::table('egreso_pacientes')
                        ->selectRaw("SUM(IF(ips_remitida = 'Hospital Universitario Erasmo Meoz', 1, 0)) AS huem")
                        ->selectRaw("SUM(IF(ips_remitida != 'Hospital Universitario Erasmo Meoz', 1, 0)) AS otra")
                        ->selectRaw("SUM(IF(ips_remitida IS NULL, 1, 0)) AS sin_respuesta")
                        ->where([['estado', 2], ['egreso_fecha', '>=', $desde], ['egreso_fecha', '<=', $hasta]])
                        ->get()
                        ;

    return $ips_remitidas;
});


Route::get('logs_egresos', function(){
    $logs = '[';
    $file = fopen(storage_path('logs/dinamica_import_egresos.log'), 'r');

    while( $linea = fgets($file) ) { 
        $logs .= $linea;
    }

    return $logs;
});


Route::get('/update_servicios', function(){
    ini_set('max_execution_time', 1200);

    $servicios = App\Models\ServicioHuem::all();

    foreach($servicios as $servicio)
    {
        //$servicio = App\Models\ServicioHuem::findOrFail();
        $servicio->servicio = preg_replace('/^(\d{2,3}-)/', '', $servicio->servicio);
        $servicio->save();
    }

    $referencias = App\Models\Referencia::all();

    foreach($referencias as $referencia)
    {
        $referencia->servicio_huem = preg_replace('/^(\d{2,3}-)/', '', $referencia->servicio_huem);
        $referencia->save();
    }

    return 'Se actualizo los servicios y las referncias.';
});


Route::get('ucwords_name_empleados', function(){
    $actualizados = 0;

    $empleados = App\Empleado::all();

    foreach($empleados as $empleado) {
        if( ! preg_match('/[Ññ]/', $empleado->nombreCompleto()) ) {
            $empleado->nombres   = ucwords(strtolower(trim(utf8_decode($empleado->nombres))));
            $empleado->apellidos = ucwords(strtolower(trim(utf8_decode($empleado->apellidos))));
            $empleado->save();

            $actualizados++;
        }
    }

    return 'Total registros actualizados: '. $actualizados .'';
});


Route::get('/seguimiento_egresos/truncate', function(){
    DB::table('spe_segundo_seguimiento')->truncate();
    DB::table('spe_primer_seguimiento')->truncate();
    DB::table('egreso_pacientes')->truncate();

    App\Models\Accion::where('modulo', '=', 'SEGUIMIENTO_POST_EGRESOS')->delete();

    return 'Los datos de las tablas spe_segundo_seguimientos, seguimiento_egresos, egreso_pacientes se vaciaron correctamente';
});


Route::get('/seguimiento_egresos/cron', function(){
    return Artisan::call('dinamica:import_egresos');
});

Route::get('/cumpleaños/cron', function(){
    return Artisan::call('huem:birthday');
});

Route::get('/schedule/run', function(){
    return Artisan::call('schedule:run');
});


Route::get('/send-mail', function(){
    $name_empleado = 'JUAN PEREZ';
    $url_image     = 'https://edtlsoft.com/developer/huemApp/api_cumple/birthday/1560876091_JUAN PEREZ.jpg';

    Mail::to('edwardlopez.huem@gmail.com')->send(new BirthdayMail($name_empleado, $url_image));
    return 'Correo enviado.';

    return view('emails.birthday')->with([
        'name_empleado' => 'JUAN PEREZ', 
        'url_image' => 'https://edtlsoft.com/developer/huemApp/api_cumple/birthday/1560876091_JUAN PEREZ.jpg'
    ]);

});


Route::get('/update_password', function(){
    $user = App\User::find(78);
    $user->password = bcrypt('13476469');
    //$user->save();

    return 'Clave No Cambiada';
});


Route::get('/betplay', function(){
    $url = 'https://betplay.com.co/apuestas#filter/football';

    $curl = \curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    //curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_POST, true);
    //curl_setopt($curl, CURLOPT_NOBODY, 1);
    
    $response = curl_exec($curl);
    $error    = curl_error($curl);

    curl_setopt($curl, CURLOPT_URL, 'https//edtlsoft.com/developer');

    $response2 = curl_exec($curl);

    if( $error ){
        var_dump($error);
    }

    return '<pre>'. $response2 .'</pre>';
});


Route::get('/migracion_bcm', function(){
    $response = '';

    for($i=1; $i <= 40; $i++) {
        $response .= '                { data: \'s'. $i .'\', searchable: false, }, <br>';
    }

    return $response;
});


Route::get('/ping_evans', function(){
    exec('ping EVANS -n 1 -w 300 -4', $data);

    var_dump($data);

    if( isset($data[2]) && preg_match('/(Respuesta\sdesde)/',$data[2]) ){ 
        echo "Ping resuelto";
    }
    else {
        echo "La solicitud de ping no pudo encontrar el host";
    }

    //return $data;
});


Route::get('/indicador_excel', function(){
    echo date('H:i:s');

    $egreso = DB::connection('sql_dg02')
                ->table('GENPACIEN')
                
                ->selectRaw("GENPACIEN.PACTIPDOC AS paciente_tipo_documento, GENPACIEN.PACNUMDOC AS paciente_documento, (GENPACIEN.PACPRINOM + ' ' + GENPACIEN.PACSEGNOM) AS paciente_nombres, (GENPACIEN.PACPRIAPE + ' ' + GENPACIEN.PACSEGAPE) AS paciente_apellidos, GENPACIEN.GPAFECNAC AS paciente_fecha_nacimiento, GENPACIEN.GPASEXPAC AS paciente_genero, GENSERIPS.SIPCODIGO AS procedimiento_codigo, GENSERIPS.SIPNOMBRE AS procedimiento_descripcion, HCMQX01.HCCM06N06 AS fecha_intervencion, GENMEDICO.GMENOMCOM AS nombre_cirujano")

                ->join('HCNFOLIO', 'HCNFOLIO.GENPACIEN', '=', 'GENPACIEN.OID')
                ->join('HCMQX01', 'HCMQX01.HCNFOLIO', '=', 'HCNFOLIO.OID')
                ->join('GENMEDICO', 'GENMEDICO.OID', '=', 'HCNFOLIO.GENMEDICO')
                ->join('GENSERIPS', 'GENSERIPS.OID', '=', 'HCMQX01.HCCM22N21')
                ->join('ultimofolioria', 'ultimofolioria.foliomaxria', '=', 'HCNFOLIO.OID')
                
                ->where('GENPACIEN.PACNUMDOC', '=', '27727302')
                ->first()
                ;
            
                echo "<br>". date('H:i:s');

    /*
    $egreso = DB::connection('sql_dg02')
                ->select(
                    DB::raw("
                        select GENPACIEN.PACTIPDOC AS paciente_tipo_documento,
                        GENPACIEN.PACNUMDOC AS paciente_documento, 
                        (GENPACIEN.PACPRINOM + ' ' + GENPACIEN.PACSEGNOM) AS paciente_nombres, 
                        (GENPACIEN.PACPRIAPE + ' ' + GENPACIEN.PACSEGAPE) AS paciente_apellidos, 
                        GENPACIEN.GPAFECNAC AS paciente_fecha_nacimiento, 
                        GENPACIEN.GPASEXPAC AS paciente_genero, 
                        GENSERIPS.SIPCODIGO AS procedimiento_codigo, 
                        GENSERIPS.SIPNOMBRE AS procedimiento_descripcion, 
                        HCMQX01.HCCM06N06 AS fecha_intervencion, 
                        GENMEDICO.GMENOMCOM AS nombre_cirujano 
                        from [GENPACIEN] inner join [HCNFOLIO] on [HCNFOLIO].[GENPACIEN] = [GENPACIEN].[OID] 
                        inner join [HCMQX01] on [HCMQX01].[HCNFOLIO] = [HCNFOLIO].[OID] 
                        inner join [GENMEDICO] on [GENMEDICO].[OID] = [HCNFOLIO].[GENMEDICO] 
                        inner join [GENSERIPS] on [GENSERIPS].[OID] = [HCMQX01].[HCCM22N21] 
                        inner join [ultimofolioria] on [ultimofolioria].[foliomaxria] = [HCNFOLIO].[OID] 
                        where [GENPACIEN].[PACNUMDOC] = '27727302'
                    ")
                );
    */

    return response()->json(['egreso' => $egreso]);

    //return Excel::download(new PruebaExport, 'indicador_excel.xlsx');
    //return View('exports.prueba');
});


/**
 * PHP INFO
 */
Route::get('/phpinfo/superadmin', function(){
    if( auth()->user()->id == 1 ){
        \phpinfo();
    }

    return '';
});

// RUTA RECURSO CONTROLLER
Route::resource('recurso', 'RecursoController');

//RUTAS ALTERNATIVA
Route::get('{path}', 'DashboardController@index')->where('path', '([A-z0-9\-\/\_\.Ññ]+)?');
