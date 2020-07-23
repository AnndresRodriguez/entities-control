<?php

namespace App\Http\Controllers\EntesControl;

use DateTime;
use App\Alarma;
use App\Evidencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Informe;
use App\Normativa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

    public function anexarEvidencias(Request $request){

        $evidencias = $request->file('evidencia');
        $id_informe = $request->id_informe;

        try {
            for($index=0; $index < count($evidencias); $index++){
                $evidenciapath = $evidencias[$index];
                $nombreFileEvidencia = $evidenciapath->getClientOriginalName();
                // $evidencia->move(storage_path('public/evidencias'), $nombreFileEvidencia);
                Storage::putFileAs('public/evidencias', $evidenciapath, $evidenciapath->getClientOriginalName());
                $pathsEvidencias[$index] = 'http://localhost:3000/storage/evidencias/'.$nombreFileEvidencia;
                $evidencia_filename = pathinfo($nombreFileEvidencia, PATHINFO_FILENAME);

                $evidencia = new Evidencia();
                $evidencia->nombre = $evidencia_filename;
                $evidencia->url_evidencia = 'http://localhost:3000/storage/evidencias/'.$nombreFileEvidencia;
                $evidencia->id_informe = $id_informe;
                $evidencia->fecha_creacion = now();
                $evidencia->fecha_edicion = now();
                $evidencia->save();

            }

            return response()->json([ "error" => false, "evidencias" => $pathsEvidencias,   "message" => 'Evidencias Subidas con éxito', "errorMessage" => '' ], 200);

        } catch(\Throwable $th){

            return response()->json([ "error" => true, "evidencias" => [], "message" => 'Ha ocurrido un error intente nuevamente', "errorMessage" => $th ], 202);
        }

    }

    public function getEvidenciasById(Request $request){
        $evidencias = Evidencia::where('id_informe', $request->id_informe)->get();
        // $evidencias = Evidencia::find($request->id_informe);
        return response()->json(["evidencias" => $evidencias], 200);
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

        // $normativa->move(storage_path('public/normativas'), $nombreFileNormativa);

        return response()->json([ "error" => false, "message" => 'Informe '.$request->nombre.' creado con éxito', "errorMessage" => '' ], 200);

        } catch (\Throwable $th) {

            return response()->json([ "error" => true, "message" => 'Ha ocurrido un error al crear el informe, intente nuevamente', "errorMessage" => $th ], 202);
            //throw $th;
        }



    }

    public function getInformes(){

        $informes = DB::table('informes')
                    ->join('dependencias', 'informes.id_dependencia', '=', 'dependencias.id')
                    ->join('entes', 'informes.id_ente_control', '=', 'entes.id')
                    ->select('informes.fecha_creacion', 'informes.nombre as nombre_informe'
                    ,'entes.nombre as nombre_ente', 'dependencias.responsable', 'dependencias.nombre as nombre_dependencia', 'informes.estado', 'informes.fecha_entrega', 'informes.id')
                    ->get();


        return response()->json(["informes" => $informes], 200);

    }

    public function setEstadoInforme(Request $request){

        try {

            $informe = Informe::find($request->id_informe);
            $informe->estado = 1;
            $informe->save();

            return response()->json([ "error" => false, "message" => 'Informe actualizado con éxito', "dataInforme" => $informe, "errorMessage" => '' ], 200);

        } catch (\Throwable $th) {

            return response()->json([ "error" => true, "message" => 'Ha ocurrido un error intente nuevamente', "dataInforme" => $informe, "errorMessage" => $th ], 202);

        }

        // $informe = Informe::where('id', $request->id_informe)->get();





    }
}
