<?php

namespace App\Http\Controllers\EntesControl;

use App\dependencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dependencias = dependencia::get();
       return response()->json(['dependencias' => $dependencias], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearDependencia(Request $request)
    {
        try {
            $dependencia = new dependencia;
            $dependencia->nombre = $request->nombre;
            $dependencia->fecha_creacion = now();
            $dependencia->responsable = $request->responsable;
            $dependencia->correo_responsable = $request->correo;
            $dependencia->save();

            return response()->json([ "error" => false, "message" => 'Dependencia creada con éxito', "errorMessage" => '' ], 200);
        }
        catch (Exception $e){

            return response()->json([ "error" => true, "message" => 'Ha ocurrido un error intente nuevamente', "errorMessage" => $e ], 204);

        }
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function editarDependencia(Request $request)
    {
        try {

            $id = $request->id;
            $dependencia = dependencia::find((int)$id);
            $dependencia->nombre = $request->nombre;
            $dependencia->fecha_creacion = now();
            $dependencia->fecha_edicion = now();
            $dependencia->responsable = $request->responsable;
            $dependencia->correo_responsable = $request->correo;
            $dependencia->save();
            return response()->json([ "error" => false, "message" => 'Datos del ente editados satisfactoriamente', "errorMessage" => '' ]);

        }

        catch (Exception $e){

            return response()->json(["error" => true, "message" => 'Ha ocurrido un error temporal intente nuevamente', "errorMessage" => $e ]);

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
