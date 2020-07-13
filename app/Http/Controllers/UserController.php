<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Image;

use App\Traits\RegistrarAccion;
use App\Traits\SesionTrait;

use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use RegistrarAccion;
    use SesionTrait;
    

    /**
     * Este metodo crea una nueva instancia del controlador.
     *
     * @return void
     */
    
    public function __construc(){
        $this->middleware('auth');
    }


    /**
     * Este metodo auntentica la sesion de un usuario.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validarSesion(Request $request)
    {
        $estado = 0;

        if( auth()->user() ) {
            $this->actualizarDuracionDeLaSesion();
            $estado = $request->user()->estado;
        }

        return response()->json(['success' => $estado]);
    }


    /**
     * Este metodo despliega los usuarios con su respecto dato empleado y role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( ! $request->ajax() ){
            return redirect()->to('/');
        }

        auth()->user()->isAuthorized('administrador');

        $usuarios = User::with('empleado')->with('role')->with('jefe_inmediato')->with('jefe_inmediato.empleado');

        return datatables()->eloquent($usuarios)->toJson();
    }


    /**
     * Este metodo lista un maximo de 10 usuarios con los filtros proporcionados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexSelect2(Request $request)
    {
        $search_documento = $this->createArrayBusquedadSelect2('documento', $request->search);
        $search_nombres   = $this->createArrayBusquedadSelect2('nombres', $request->search);
        $search_apellidos = $this->createArrayBusquedadSelect2('apellidos', $request->search);

        $empleados = User::whereHas('empleado', function($query) use ($search_documento, $search_nombres, $search_apellidos){
                        $query->where($search_documento)->orWhere($search_nombres)->orWhere($search_apellidos);
                    })
                    ->with('empleado')
                    ->limit(10)
                    ->get();

        return response()->json(['empleados' => $empleados]);
    }

    /**
     * Este metodo retorna un arreglo con los datos columna y parametros de busquedad.
     * Nombre Recomendado: busquedaIndexDescripcion
     * 
     * @param String $columna
     * @param String $diagnostico
     * @return Array
     */
    public function createArrayBusquedadSelect2($columna, $search)
    {
        $response = [];

        $data = explode(' ', $search);

        foreach( $data as $param ){
            $response[] = [ $columna, 'LIKE', '%'.$param.'%' ];
        }

        return $response;
    }


    /**
     * Este metodo registra un usuario con su respectiva informacion y se guarda la accion en una base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->isAuthorized('administrar_usuarios');

        $response = ['success' => 0, 'msgerror' => ''];

        $usuario = new User();
        $usuario->empleado_id       = $request->empleado_id;
        $usuario->role_id           = $request->role_id;
        $usuario->username          = $request->username;
        $usuario->password          = bcrypt($request->password);
        $usuario->email             = $request->email;
        $usuario->jefe_inmediato_id = $request->jefe_inmediato_id;
        $usuario->save();

        if( $usuario->id ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del usuario se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'USERS',
                'accion'      => 'REGISTRAR',
                'id_registro' => $usuario->id,
                'observacion' => 'REALIZO EL REGISTRO DEL USUARIO #'. $usuario->id .'',
            ];
    
            $this->storeAccion($accion);
        }
        else {
            $response['success']  = 0;
            $response['msgerror'] = 'Ocurrio un error al intentar registrar el usuario, intentelo nuevamente.';
        }

        return response()->json($response);
    }

    /**
     * Este metodo despliega la informacion de un usuario especifico
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario = auth()->user()->getAllData();

        return response()->json(compact('usuario'));
    }

   
    /**
     * Este metodo le permite al usuario actualizar su username, email y password.
     *
     * @param  \App\Http\Request\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $usuario = User::find( auth()->user()->id );

        $usuario->username = $request->username;
        $usuario->email    = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        if( $usuario->wasChanged() ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del usuario se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'PERFIL',
                'tabla'       => 'USERS',
                'accion'      => 'ACTUALIZAR',
                'id_registro' => $usuario->id,
                'observacion' => 'EL USUARIO #'. $usuario->id .' REALIZO LA ACTUALIZACION DE SUS DATOS A TRAVEZ DEL MODULO DE PERFIL',
            ];
    
            $this->storeAccion($accion);
        }

        return response()->json(['success' => 1]);
    }

    /**
     * Este metodo permite actualizar todos los campos de un usuario.
     *
     * @param  \App\Http\Request\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        $usuario = User::findOrFail($request->id);

        $usuario->empleado_id       = $request->empleado_id;
        $usuario->role_id           = $request->role_id;
        $usuario->username          = $request->username;
        $usuario->email             = $request->email;
        $usuario->jefe_inmediato_id = $request->jefe_inmediato_id;
        
        if( \trim($request->password) !== '' ){
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        if( $usuario->wasChanged() ) {
            $response['success']  = 1;
            $response['msgerror'] = 'Los datos del usuario se registraron correctamente.';

            $accion = [
                'user_id'     => $request->user()->id,
                'modulo'      => 'AUTENTICACION',
                'tabla'       => 'USERS',
                'accion'      => 'ACTUALIZAR',
                'id_registro' => $usuario->id,
                'observacion' => 'REALIZO LA ACTUALIZACION DE TODOS LOS DATOS DEL USUARIO #'. $usuario->id .'',
            ];
    
            $this->storeAccion($accion);
        }

        

        return response()->json(['success' => 1]);
    }

   /**
     * Este metodo actualiza la imagen de perfil de un usuario en especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateImageProfile(Request $request)
    {
        $response = ['success' => 0, 'msgerror' => ''];

        $user_id  = auth()->user()->id;  sleep(1);

        if( $request->has('imagen-perfil') ) {
            $ruta_file = $this->storedImageProfile( $request->file('imagen-perfil'), $user_id );

            $usuario = User::find( $user_id );
            $usuario->image_profile = $ruta_file;
            $usuario->save();

            $response['success']  = 1;
            $response['image']    = $usuario->image_profile;
            $response['msgerror'] = 'La imagen de perfil se actualizo correctamente.';
        } 
        else {
            $response['msgerror'] = 'Debe seleccionar una imagen valida.';
        }

        return response()->json($response);
    }

    /**
     * Este metodo guarda la informacion de la imagen como: tamaño, ubicacion y nombre.
     * 
     * @param  int $user_id
     * @param String $file
     * @return String
     */
    protected function storedImageProfile($file, $user_id) 
    {
        $image_width = getimagesize($file)[0];

        $folder_user = '/images/profile/'. $user_id .'/';
        $folder_path = public_path($folder_user);
        $name_file   = 'image_profile_'. time() .'.'. $file->getClientOriginalExtension();

        $img = Image::make($file->getRealPath())
                ->resize($image_width, $image_width)
                ->save($folder_path . $name_file);

        return($folder_user . $name_file);
    }


    /**
     * Este metodo actualiza el estado de un usuario en especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $usuario = User::find($request->id);
        $usuario->estado = $request->estado;
        $usuario->save();

        return response()->json(['success' => 1]);
    }


    /**
    * Este metodo despliega un listado de usuarios filtrados por su acreditacion.
    *
    * @return \Illuminate\Http\Response
    */
    public function showAcreditacion()
    {
        $usuarios = User::where('acreditacion', '1')
                    ->with('empleado')
                    ->get();

        return response()->json(['usuarios' => $usuarios]);
    }
}
