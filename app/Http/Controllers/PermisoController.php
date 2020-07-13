<?php

namespace App\Http\Controllers;

use App\Permiso;
use Illuminate\Http\Request;

use App\Traits\RegistrarAccion;

class PermisoController extends Controller
{
    use RegistrarAccion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( ! $request->ajax() ){
            return redirect()->to('/');
        }

        $permisos = Permiso::with('roles');

        return datatables()->eloquent($permisos)->toJson();
    }

    /**
     * Este metodo genera un nuevo permiso y se guarda la accion en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->isAuthorized('administrar_permisos');

        $response = ['success' => 0, 'msgerror' => ''];

        $permiso = new Permiso();
        $permiso->nombre      = $request->nombre;
        $permiso->descripcion = $request->descripcion;
        $permiso->ruta        = $request->ruta;
        $permiso->save();

        if( $permiso->id ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del permiso se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'PERMISOS',
                'accion'      => 'REGISTRAR',
                'id_registro' => $permiso->id,
                'observacion' => 'REALIZO EL REGISTRO DEL PERMISO #'. $permiso->id .'',
            ];
    
            $this->storeAccion($accion);
        }
        else {
            $response['success']  = 0;
            $response['msgerror'] = 'Ocurrio un error al intentar registrar el permiso, intentelo nuevamente.';
        }

        return response()->json($response);
    }

    /**
     * Este metodo despliega una lista de 10 permisos pertenecientes a su correspondiente rol
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSelect2(Request $request)
    {
        $search_nombres   = $this->createArrayBusquedadSelect2('nombre', $request->search);

        $permisos = Permiso::select('id', 'nombre')
                    ->where($search_nombres)
                    ->where('estado', 1)
                    ->limit(10)->get();

        return response()->json(['permisos' => $permisos]);
    }

     /**
     * Este metodo retorna un arreglo con los parametros de busqueda de una descripcion
     * Nombre Recomendado: busquedaIndexDiagnostico
     * 
     * @param String $columna
     * @param String $diagnostico
     * @return Array
     */

    public function createArrayBusquedadSelect2($columna, $descripcion)
    {
        $response = [];

        $data = explode(' ', $descripcion);

        foreach( $data as $param ){
            $response[] = [ $columna, 'LIKE', '%'.$param.'%' ];
        }

        return $response;
    }

    /**
     * Este metodo actualiza los datos de un permiso en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->user()->isAuthorized('administrar_permisos');

        $response = ['success' => 0, 'msgerror' => ''];

        $permiso              = Permiso::findOrFail($request->id);
        $permiso->nombre      = $request->nombre;
        $permiso->descripcion = $request->descripcion;
        $permiso->ruta        = $request->ruta;
        $permiso->save();

        if( $permiso->wasChanged() ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del permiso se actualizaron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'PERMISOS',
                'accion'      => 'ACTUALIZAR',
                'id_registro' => $permiso->id,
                'observacion' => 'REALIZO LA ACTUALIZACION DE LOS DATOS DEL PERMISO #'. $permiso->id .'',
            ];
    
            $this->storeAccion($accion);
        }
        else {
            $response['success']  = 0;
            $response['msgerror'] = 'Ocurrio un error al intentar registrar el permiso, intentelo nuevamente.';
        }

        return response()->json($response);
    }


    /**
     * Este metodo actualiza el estado de un permiso por su id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $permiso = Permiso::find($request->id);
        $permiso->estado = $request->estado;
        $permiso->save();

        return response()->json(['success' => 1]);
    }
}
