<?php

namespace App\Http\Controllers\EntesControl;

use App\Ente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entes = Ente::get();
        return response()->json(['entes' => $entes], 200);
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
    public function store(Request $request)
    {
        try {

            $ente = new Ente;
            $ente->nombre = $request->nombre;
            $ente->fecha_creacion = now();
            $ente->fecha_edicion = now();
            $ente->save();

            return response()->json([ "error" => false, "message" => 'Ente creado satisfactoriamente', "errorMessage" => '' ], 200);
        }

        catch( Exception $e ){
            return response()->json(["error" => true, "message" => 'Ha ocurrido un error temporal intente nuevamente', "errorMessage" => $e ], 202);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {

            $id = $request->id;
            $ente = Ente::find((int)$id);
            $ente->nombre = $request->nuevoNombre;
            $ente->fecha_edicion = now();
            $ente->save();
            return response()->json([ "error" => false, "message" => 'Nombre del ente editado satisfactoriamente', "errorMessage" => '' ]);
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
