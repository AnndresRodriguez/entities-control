<?php

namespace App\Http\Controllers\GestorPermisos;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GestorPermisos\GesperSoftware;

class GesperSoftwareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GesperSoftware::with('modulos.procesos')->orderBy('relevancia')->get()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:4|unique:gesper_softwares,nombre',
        ], [
            'nombre.require' => 'El nombre del software es requerido.',
            'nombre.min' => 'El nombre del software debe tener al menos 4 caracteres.',
            'nombre.unique' => 'El software ya ha sido registrado.',
        ]);

        $software = new GesperSoftware();
        $software->nombre = \mb_strtoupper($request->nombre);
        $software->slug   = Str::slug($request->nombre);
        $software->save();

        return $software->load('modulos.procesos');
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
    public function edit($id)
    {
        //
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
