<?php

namespace App\Http\Controllers\GestorPermisos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\GestorPermisos\GesperPermisosUsuario;
use App\Models\GestorPermisos\GesperSolicitudesRetiro;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\NotificacionJefeInmediatoSolictudPermisos;
use App\Mail\NotificacionAdministradoresPermisosValidados;
use App\Mail\NotificacionColaboradorPermisosAsignados;
use App\Traits\RegistrarAccion;

class GesperPermisosUsuarioController extends Controller
{
    use RegistrarAccion;

    public function __construct()
    {
        $this->middleware('auth')->except(['rutaValidarPermisos']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        return GesperPermisosUsuario::where('user_id', $user_id)->with('proceso')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dump($request->all());

        $user_id   = auth()->user()->id;
        $permisos  = $request->all();
        $registros = [];

        foreach ($permisos as $permiso) {
            $pu = GesperPermisosUsuario::firstOrCreate([
                'user_id'           => $user_id,
                'gesper_proceso_id' => $permiso['id'],
            ], [
                'ver'      => $permiso['ver'],
                'agregar'  => $permiso['agregar'],
                'editar'   => $permiso['editar'],
                'imprimir' => $permiso['imprimir'],
                'exportar' => $permiso['exportar'],
                'eliminar' => $permiso['eliminar'],
                'estado'   => 1,
                'fecha_vencimiento' => null,
            ]);

            if ($pu->id >= 1) {
                $registros[] = $pu->load('proceso.modulo.software');
            }
        }

        $this->notificarPorCorreoJefeInmediato($registros);

        return response()->json(['registros' => $registros], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function renovar(Request $request)
    {
        //dump($request->all());

        $user_id   = auth()->user()->id;
        $permisos  = $request->all();
        $registros = [];

        foreach ($permisos as $permiso) {
            $pu = GesperPermisosUsuario::findOrFail($permiso['id']);
            $pu->fecha_vencimiento = null;
            $pu->estado = 1;
            $pu->save();

            if ($pu->id >= 1) {
                $registros[] = $pu->load('proceso.modulo.software');
            }
        }

        $this->notificarPorCorreoJefeInmediato($registros);

        return response()->json(['registros' => $registros], 200);
    }

    public function notificarPorCorreoJefeInmediato($registros)
    {
        if (count($registros)) {
            $jefe_inmediato = auth()->user()->jefe_inmediato;

            Mail::to($jefe_inmediato->email)
            //->bcc('edwardlopez.huem@gmail.com')
            ->send(new NotificacionJefeInmediatoSolictudPermisos($jefe_inmediato, $registros))
            ;
        }

        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GestorPermisos\GesperPermisosUsuario  $gesperPermisosUsuario
     * @return \Illuminate\Http\Response
     */
    public function rutaValidarPermisos(Request $request)
    {
        if (!\Auth::check()) {
            $user = User::findOrFail(Crypt::decrypt($request->jefe));

            \Auth::login($user);
        }

        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GestorPermisos\GesperPermisosUsuario  $gesperPermisosUsuario
     * @return \Illuminate\Http\Response
     */
    public function subalternos()
    {
        return auth()->user()->subalternos->load('empleado', 'permisos_solicitados.proceso.modulo.software');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validar(Request $request)
    {
        $user_id   = auth()->user()->id;
        $permisos  = $request->all();
        $registros = [];

        foreach ($permisos as $permiso) {
            $pu = GesperPermisosUsuario::findOrFail($permiso['id']);

            $pu->fecha_vencimiento = $permiso['fecha_vencimiento'];
            $pu->estado            = 2;
            
            $pu->save();

            if ($pu->id >= 1) {
                $registros[] = $pu->load('proceso.modulo.software');
            }
        }

        $this->notificarPorCorreoAdministradores($registros);

        return response()->json(['registros' => $registros], 200);
    }


    public function notificarPorCorreoAdministradores($registros)
    {
        if (count($registros)) {
            $users = User::whereHas('role.permisos', function ($query) {
                $query->whereIn('permisos.nombre', ['super_administrador', 'gestor_permisos_asignar']);
            })
            ->select('email')
            ->get()
            ->toArray()
            ;

            $correos = implode(',', \array_map(function ($user) {
                return $user['email'];
            }, $users));

            //dd($registros[0]->id);

            $empleado = GesperPermisosUsuario::findOrFail($registros[0]->id)->user->load('empleado');

            Mail::to($correos)
            //->bcc('edwardlopez.huem@gmail.com')
            ->send(new NotificacionAdministradoresPermisosValidados($registros, $empleado))
            ;
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GestorPermisos\GesperPermisosUsuario  $gesperPermisosUsuario
     * @return \Illuminate\Http\Response
     */
    public function adminColaboradores()
    {
        auth()->user()->isAuthorized(['gestor_permisos_administrador', 'gestor_permisos_asignar']);

        return User::with('empleado', 'jefe_inmediato.empleado', 'permisos_solicitados.proceso', 'solicitud_retiro')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GestorPermisos\GesperPermisosUsuario  $gesperPermisosUsuario
     * @return \Illuminate\Http\Response
     */
    public function permisoAsignado(Request $request, GesperPermisosUsuario $permiso)
    {
        $permiso->update([
            'estado' => $request->estado,
        ]);

        if ($permiso->id) {
            $accion = [
                'user_id'     => auth()->user()->id,
                'modulo'      => 'GESTOR_PERMISOS',
                'tabla'       => 'GESPER_PERMISOS_USUARIOS',
                'accion'      => 'ACTUALIZAR',
                'id_registro' => $permiso->id,
                'observacion' => 'DIO DE ALTA EL PERMISO SOLICITADO CON ID #'. $permiso->id .'',
            ];

            $this->storeAccion($accion);

            return response()->json(['estado' => $permiso->estado]);
        }

        return response()->json([
            'errors' => [
                'failed' => ['Ocurrio un error al intentar dar de alta el permiso solicitado, intentelo nuevamente.']
            ],
        ], 401);
    }

    public function notificarPermisos(Request $request)
    {
        $empleado = \App\User::findOrFail($request->id);

        $permisos = $empleado->permisos_solicitados()->where('estado', 3)->get();

        Mail::to($empleado->email)
        //->bcc('edwardlopez.huem@gmail.com')
        ->send(new NotificacionColaboradorPermisosAsignados($empleado, $permisos))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GestorPermisos\GesperPermisosUsuario  $gesperPermisosUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(GesperPermisosUsuario $permiso)
    {
        if ($permiso->delete()) {
            $accion = [
                'user_id'     => auth()->user()->id,
                'modulo'      => 'GESTOR_PERMISOS',
                'tabla'       => 'GESPER_PERMISOS_USUARIOS',
                'accion'      => 'ELIMINAR',
                'id_registro' => $permiso->id,
                'observacion' => 'REALIZO LA ELIMINACIÓN DEL PERMISO SOLICITADO CON ID #'. $permiso->id .'',
            ];

            $this->storeAccion($accion);

            return response()->json(['success' => 1]);
        }

        return response()->json([
            'errors' => [
                'failed' => ['Ocurrio un error al intentar eliminar el permiso solicitado, intentelo nuevamente.']
            ],
        ], 401);
    }
}
