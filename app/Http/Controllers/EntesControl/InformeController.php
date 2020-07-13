<?php

namespace App\Http\Controllers\EntesControl;

use App\Alarma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Informe;
use App\Normativa;
use Illuminate\Support\Facades\Storage;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informes = Informe::get();
        return response()->json(['informes' => $informes], 200);

    }

    public function crearInforme(Request $request)
    {

        try {

        $normativaFile = $request->file('normativa');
        $nombreFileNormativa = $normativaFile->getClientOriginalName();
        Storage::putFileAs('public/normativas', $normativaFile, $normativaFile->getClientOriginalName());
        $pathNormativa = 'http://localhost:3000/storage/normativas/'.$nombreFileNormativa;

        $normativa = new Normativa;
        $normativa->url_normativa = $pathNormativa;
        $normativa->fecha_creacion = now();
        $normativa->fecha_edicion = now();
        $normativa->save();


        $informe = new Informe();
        $informe->nombre = $request->nombre;
        $informe->id_ente_control = $request->id_ente_control;
        $informe->id_dependencia = $request->id_dependencia;
        $informe->id_normativa = $normativa->id;

        $js_fecha_entrega = $request->fecha_entrega;
        $php_fecha_entrega = substr($js_fecha_entrega, 0, strpos($js_fecha_entrega, '('));
        $format_fecha_entrega = date('Y-m-d h:i:s', strtotime($php_fecha_entrega));

        $js_fecha_final_entregas = $request->fecha_final_entregas;
        $php_fecha_final_entregas = substr($js_fecha_final_entregas, 0, strpos($js_fecha_final_entregas, '('));
        $format_fecha_final_entregas = date('Y-m-d h:i:s', strtotime($php_fecha_final_entregas));



        $informe->fecha_entrega = $format_fecha_entrega;
        $informe->fecha_final_entregas = $format_fecha_final_entregas;
        $informe->estado = 0;
        $informe->fecha_creacion = now();
        $informe->fecha_edicion = now();
        $informe->save();
        $id_informe = $informe->id;

        // $alarmas = json_decode($request->alarmas);
        $alarmas = $request->input('alarmas');


        for($index=0; $index < count($alarmas); $index++){

            $alarma_db = new Alarma();
            $alarma = $alarmas[$index];
            $format_fecha_alarma = substr($alarma, 0, strpos($alarma, '('));
            $fecha_hora_alarma = date('Y-m-d h:i:s', strtotime($format_fecha_alarma));
            $alarma_db->fecha_hora_alarma = $fecha_hora_alarma;
            $alarma_db->id_informe = $id_informe;
            $alarma_db->fecha_creacion = now();
            $alarma_db->fecha_edicion = now();
            $alarma_db->save();

        }

        // $pathsEvidencias = array();
        // $normativa->move(storage_path('public/normativas'), $nombreFileNormativa);

        // $evidencias = $request->file('evidencia');

        // for($index=0; $index < count($evidencias); $index++){
        //     $evidencia = $evidencias[$index];
        //     $nombreFileEvidencia = $evidencia->getClientOriginalName();
        //     // $evidencia->move(storage_path('public/evidencias'), $nombreFileEvidencia);
        //     Storage::putFileAs('public/evidencias', $evidencia, $evidencia->getClientOriginalName());
        //     $pathsEvidencias[$index] = 'evidencias/'.$nombreFileEvidencia;
        // }

        // return response()->json([
        //      "idInforme" => $informe->id,
        //      "nombre" => $request->nombre,
        //      "idNormativa" => $normativa->id,
        //      "urlnormativa" => $pathNormativa,
        //      "fechaEntrega" => $format_fecha_entrega,
        //      "alarmas" => $alarmas,
        //      "lengthAlarmas" => count($alarmas)
        // ], 200);

        return response()->json([ "error" => false, "message" => 'Informe '.$request->nombre.' creado con éxito', "errorMessage" => '' ], 200);

            //code...
        } catch (\Throwable $th) {

            return response()->json([ "error" => true, "message" => 'Ha ocurrido un error al crear el informe, intente nuevamente', "errorMessage" => $th ], 202);
            //throw $th;
        }



    }
}
