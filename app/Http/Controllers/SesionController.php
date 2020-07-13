<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;

class SesionController extends Controller
{
    /**
     * Este metodo despliega una lista de sesiones activas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( ! $request->ajax() ){
            return redirect()->to('/');
        }
        
        auth()->user()->isAuthorized('sesiones_view');

        $filtros = [
            ['estado', 1],
        ];


        $sesiones = Sesion::where($filtros)
                    ->with('user.empleado')
                    ->with('user.role')
                    ;

        return datatables()->eloquent($sesiones)->toJson();
    }
}
