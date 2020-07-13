<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccionController extends Controller
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
    public function index(Request $request)
    {
        if (! $request->ajax()) {
            return redirect()->to('/');
        }
        
        auth()->user()->isAuthorized(['acciones_view', 'seguimiento_egresos_acciones']);

        $filtros = [
            ['estado', '=', 1],
        ];

        if ($request->has('modulo')) {
            $filtros[] = ['modulo', ($request->modulo == 'TODOS' ? '!=' : '='), $request->modulo];
        }

        if ($request->has('usuario')) {
            $filtros[] = ['user_id', ($request->usuario == 'TODOS' ? '!=' : '='), $request->usuario];
        }


        $acciones = Accion::where($filtros)
                    ->with('user.empleado')
                    ;

        return datatables()->eloquent($acciones)->toJson();
    }


    /**
     * Este metodo almacena los datos de la accion para la entidad
     *
     * @param  Array datos
     * @return \Illuminate\Http\Response
     */
    public function store($datos)
    {
        $accion = new Accion();

        $accion->user_id     = $datos['user_id'];
        $accion->modulo      = $datos['modulo'];
        $accion->tabla       = $datos['tabla'];
        $accion->accion      = $datos['accion'];
        $accion->id_registro = $datos['id_registro'];
        $accion->observacion = $datos['observacion'];
        $accion->fecha       = date('Y-m-d');
        $accion->hora        = date("G: i: s A");
        $accion->save();


        if ($accion->id >= 1) {
            return $accion->id;
        }

        return 0;
    }

    /**
     * Este metodo retorna una lista de los modulos que han sido registrados en la entidad accion
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function groupByModulos()
    {
        auth()->user()->isAuthorized(['acciones_view']);

        $modulos = Accion::select('modulo')->groupBy('modulo')->get();

        return response()->json(['modulos' => $modulos]);
    }

    /**
     * Este metodo retorna una lista de los usuarios que han realizado una accion en determinado modulo.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function usuariosPorModulo(Request $request)
    {
        auth()->user()->isAuthorized(['acciones_view', 'seguimiento_egresos_acciones']);

        $operador = $request->modulo == 'TODOS' ? '<>' : '=';

        $usuarios = Accion::select('user_id')->where('modulo', $operador, $request->modulo)->groupBy('user_id')->with('user.empleado')->get();

        return response()->json(['usuarios' => $usuarios]);
    }

    /**
     * Este metodo obtiene el numero de registros realizados por usuarios en un plazo determinado de fechas
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function registrosPorUsuario(Request $request)
    {
        auth()->user()->isAuthorized(['acciones_view', 'seguimiento_egresos_acciones']);

        $modulo = $request->modulo;
        $desde  = $request->desde;
        $hasta  = $request->hasta;

        $sql = "select acciones.user_id, CONCAT(empleados.nombres, ' ', empleados.apellidos) as nombre, COUNT(acciones.id) as registros ";
        $sql.= "from acciones ";
        $sql.= "left join users on users.id=acciones.user_id ";
        $sql.= "left join empleados on empleados.id=users.empleado_id ";
        $sql.= "where acciones.modulo='$modulo' and acciones.fecha >= '$desde' and acciones.fecha <= '$hasta' ";
        $sql.= "group by acciones.user_id, empleados.nombres, empleados.apellidos ";

        $registros_por_usuario = DB::select(DB::raw($sql));  //dd($registros_por_usuario);

        $response = [];

        foreach ($registros_por_usuario as $regitros_user) {
            $response[] = [
                'nombre'    => $regitros_user->nombre,
                'registros' => $regitros_user->registros,
            ];
        }

        return response()->json(['registros_por_usuario' => $response]);
    }

    public function arrays()
    {
        $arrayName = array('a' => 1,'b' => 2);
        $a = 1;
    }
}
