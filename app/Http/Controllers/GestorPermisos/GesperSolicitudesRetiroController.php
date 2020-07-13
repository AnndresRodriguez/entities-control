<?php

namespace App\Http\Controllers\GestorPermisos;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GestorPermisos\GesperSolicitudesRetiro;
use App\Models\GestorPermisos\GesperPermisosUsuario;

class GesperSolicitudesRetiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $retiro = new GesperSolicitudesRetiro();
        $retiro->user_id = auth()->user()->id;
        $retiro->estado  = 1;
        $retiro->save();

        return response()->json([
            'success' => 1,
            'solicitud_retiro' => $retiro,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarBaja(Request $request)
    {
        $permisos = GesperPermisosUsuario::where('user_id', $request->user_id)->delete();

        $retiro = GesperSolicitudesRetiro::where('user_id', $request->user_id)->first();
        $retiro->administrador_id = auth()->user()->id;
        $retiro->fecha_retiro     = date('Y-m-d h:i:s');
        $retiro->estado           = 2;
        $retiro->save();

        return response()->json([
            'success'  => 1,
            'permisos' => $permisos,
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GestorPermisos\GesperSolicitudesRetiro  $gesperSolicitudesRetiro
     * @return \Illuminate\Http\Response
     */
    public function imprimir(Request $request)
    {
        $id = \intval(\base64_decode($request->id));

        $retiro = GesperSolicitudesRetiro::find($id)->load(['empleado', 'administrador']);

        //return View('exports.solicitud_retiro', [
        //    'retiro' => $retiro,
        //]);

        $pdf = PDF::LoadView('exports.solicitud_retiro', [
            'retiro' => $retiro,
        ]);

        return $pdf->stream('paz_y_salvo_aplicativos_huem.pdf');
    }

}
