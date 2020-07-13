<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;

use App\Traits\RegistrarAccion;

class EmpleadoController extends Controller
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

        $empleados = Empleado::where('id', '>=', 1);

        return datatables()->eloquent($empleados)->toJson();
    }
     /**
     * Este metodo muestra informacion de la base de datos de los empleados y guarda la accion en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->isAuthorized('administrar_empleados');

        $response = ['success' => 0, 'msgerror' => ''];

        $empleado = new Empleado();
        $empleado->documento        = $request->documento;
        $empleado->nombres          = $request->nombres;
        $empleado->apellidos        = $request->apellidos;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->genero           = $request->genero;
        $empleado->cargo            = $request->cargo;
        $empleado->save();

        if( $empleado->id ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del empleade se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'EMPLEADOS',
                'accion'      => 'REGISTRAR',
                'id_registro' => $empleado->id,
                'observacion' => 'REALIZO EL REGISTRO DEL EMPLEADO #'. $empleado->id .'',
            ];
    
            $this->storeAccion($accion);
        }
        else {
            $response['success']  = 0;
            $response['msgerror'] = 'Ocurrio un error al intentar registrar el empleado, intentelo nuevamente.';
        }

        return response()->json($response);
    }


    /**
     * Este metodo actualiza la informacion del empleado obtenido por el id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $empleado = Empleado::find($request->id);

        //$empleado->documento = $request->documento;
        $empleado->nombres          = $request->nombres;
        $empleado->apellidos        = $request->apellidos;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->genero           = $request->genero;
        $empleado->cargo            = $request->cargo;
        $empleado->save();

        return response()->json(['success' => 1]);
    }



    /**
     * Este metodo actualiza el estado del empleado obtenido por el id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $empleado = Empleado::find($request->id);
        $empleado->estado = $request->estado;
        $empleado->save();

        return response()->json(['success' => 1]);
    }

    /**
     * Este metodo enlista un maximo de 10 empleados, recibidos como parametros
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexSelect2(Request $request)
    {
        $search_documento = $this->createArrayBusquedadSelect2('documento', $request->search);
        $search_nombres   = $this->createArrayBusquedadSelect2('nombres', $request->search);
        $search_apellidos = $this->createArrayBusquedadSelect2('apellidos', $request->search);

        $empleados = Empleado::where($search_documento)
                    ->orWhere($search_nombres)
                    ->orWhere($search_apellidos)
                    ->limit(10)
                    ->get();

        return response()->json(['empleados' => $empleados]);
    }

    /**
     * Este metodo retorna un arreglo con los parametros de busqueda de una descripcion
     * Nombre Recomendado: busquedaIndexDescripcion
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
     * Este metodo despliega una lista de todos los jefes de enfermeria
     *
     * @return \Illuminate\Http\Response
     */
    public function jefesEnfermeria()
    {
        $jefes_enfermeria = Empleado::where('cargo', 'JEFE DE ENFERMERIA')->orderBy('nombres')->orderBy('apellidos')->get();

        return response()->json(['jefes_enfermeria' => $jefes_enfermeria]);
    }


}
