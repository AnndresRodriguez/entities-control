<?php

namespace App\Http\Controllers\GestorPermisos;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GestorPermisos\GesperModulo;

class GesperModuloController extends Controller
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
        $request->validate([
            'gesper_software_id' => 'required|exists:gesper_softwares,id',
            'nombre' => 'required|min:4',
        ], [
            'gesper_software_id.require' => 'El id del software al cual pertenece el proceso es requerido.',
            'gesper_software_id.exists' => 'El software no se ha sido registrado aun en la base de datos.',

            'nombre.require' => 'El nombre del modulo es requerido.',
            'nombre.min' => 'El nombre del modulo debe tener al menos 4 caracteres.',
        ]);

        $modulo = new GesperModulo();
        $modulo->gesper_software_id = $request->gesper_software_id;
        $modulo->nombre             = \mb_strtoupper($request->nombre);
        $modulo->slug               = $this->getSlug($modulo);
        $modulo->save();

        return $modulo->load('procesos');
    }

    public function getSlug(GesperModulo $modulo)
    {
        $slug = $modulo->software->nombre .'-'. $modulo->nombre;
        
        return Str::slug($slug);
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
