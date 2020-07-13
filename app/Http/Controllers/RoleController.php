<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

use App\Traits\RegistrarAccion;

class RoleController extends Controller
{
    use RegistrarAccion;

    /**
     * Este metodo despliega los permisos correspondientes del rol
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( ! $request->ajax() ){
            return redirect()->to('/');
        }

        $roles = Role::with('permisos');

        return datatables()->eloquent($roles)->toJson();
    }

    /**
     * Este metodo realiza el registro de un rol y se guarda la accion en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->isAuthorized('administrar_roles');

        $response = ['success' => 0, 'msgerror' => ''];

        $role = new Role();
        $role->nombre      = $request->nombre;
        $role->descripcion = $request->descripcion;
        $role->save();

        if( $role->id ) {
            $role->permisos()->sync($request->permisos);

            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del rol se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'ROLES',
                'accion'      => 'REGISTRAR',
                'id_registro' => $role->id,
                'observacion' => 'REALIZO EL REGISTRO DEL ROL #'. $role->id .'',
            ];
    
            $this->storeAccion($accion);
        }
        else {
            $response['success']  = 0;
            $response['msgerror'] = 'Ocurrio un error al intentar registrar el rol, intentelo nuevamente.';
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->user()->isAuthorized('administrar_roles');

        $response = ['success' => 1, 'msgerror' => 'Los datos del rol se actualizaron correctamente.'];

        $role = Role::findOrFail($request->id);
        $role->nombre      = $request->nombre;
        $role->descripcion = $request->descripcion;
        $role->permisos()->sync($request->permisos);
        $role->save();
        
        //dd($role, $request);

        if( $role->wasChanged() ) {
            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'ROLES',
                'accion'      => 'ACTUALIZAR',
                'id_registro' => $role->id,
                'observacion' => 'REALIZO LA ACTUALIZACION DEL ROL #'. $role->id .'',
            ];
    
            $this->storeAccion($accion);
        }

        return response()->json($response);
    }


    /**
     * Este metodo despliega hasta un maximo de 10 roles de estado activo
     * Nombre Recomendado: mostrarRoles
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexSelect2(Request $request)
    {
        $search_nombres   = $this->createArrayBusquedadSelect2('nombre', $request->search);

        $roles = Role::select('id', 'nombre')
                    ->where($search_nombres)
                    ->where('estado', 1)
                    ->limit(10)->get();

        return response()->json(['roles' => $roles]);
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
     * Este metodo actualiza el estado de un role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $role = Role::find($request->id);
        $role->estado = $request->estado;
        $role->save();

        return response()->json(['success' => 1]);
    }
}
