<?php

namespace App\Http\Controllers\GestorPermisos;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GestorPermisos\GesperProceso;

class GesperProcesoController extends Controller
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
            'gesper_modulo_id' => 'required|exists:gesper_modulos,id',
            'nombre' => 'required|min:4',
        ], [
            'gesper_modulo_id.require' => 'El id del modulo al cual pertenece el proceso es requerido.',
            'gesper_modulo_id.exists' => 'El modulo no se ha sido registrado aun en la base de datos.',

            'nombre.require' => 'El nombre del proceso es requerido.',
            'nombre.min' => 'El nombre del proceso debe tener al menos 4 caracteres.',
        ]);

        $proceso = new GesperProceso();
        $proceso->gesper_modulo_id = $request->gesper_modulo_id;
        $proceso->nombre           = \mb_strtoupper($request->nombre);
        $proceso->slug             = $this->getSlug($proceso);
        $proceso->save();

        return $proceso;
    }

    public function getSlug(GesperProceso $proceso)
    {
        $slug = $proceso->modulo->software->nombre .'-'. $proceso->modulo->nombre .'-'. $proceso->nombre;
        
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
