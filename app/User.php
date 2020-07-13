<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Los atributos que son asignables.
     *
     * @var Array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];
    

    /**
     * Los atributos que se deben ocultar para las matrices.
     *
     * @var Array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Metodo para acceder a la relacion del modelo usuario con el modelo role
     *
     * @return Object role
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Metodo para acceder a la relacion del modelo usuario con el modelo empleado
     *
     * @return Object Empleado
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    /**
     * Metodo para acceder a la relacion con el usuario asignado como jefe inmediato.
     *
     * @return Object
     */
    public function jefe_inmediato()
    {
        return $this->belongsTo(User::class, 'jefe_inmediato_id');
    }

    /**
     * Metodo para acceder a la relacion con los usuario asignados como subalternos.
     *
     * @return Object
     */
    public function subalternos()
    {
        return $this->hasMany(User::class, 'jefe_inmediato_id');
    }


    /**
     * Metodo para acceder a la relacion con los usuario asignados como subalternos.
     *
     * @return Object
     */
    public function permisos_solicitados()
    {
        return $this->hasMany(\App\Models\GestorPermisos\GesperPermisosUsuario::class, 'user_id');
    }

    /**
     * Metodo para acceder a la relacion con la tabla gesper_solicitudes_retiro.
     *
     * @return Object
     */
    public function solicitud_retiro()
    {
        return $this->hasOne(\App\Models\GestorPermisos\GesperSolicitudesRetiro::class);
    }


    /**
     * Verificar si el usuarios tiene los permisos requeridos para realizar una a accion.
     *
     * @param Array $permisos
     * @param null $frontend
     * @return boolean
     */
    public function isAuthorized($permisos, $frontend=null)
    {
        $permisos = $this->addPermisosForDefault($permisos);

        if ($this->hasAnyPermiso($permisos)) {
            return true;
        }

        return $frontend ? false : abort(401, 'No tiene permisos para realizar esta acción, si cree que pueda ser un error del sistema comuníquese con el administrador.');
    }

    /**
     * Proporciona por defecto permiso de administrador para realizar acciones en los modulos.
     *
     * @param Array $permisos
     * @return Array
     */
    public function addPermisosForDefault($permisos)
    {
        if (is_array($permisos)) {
            array_unshift($permisos, 'super_administrador');
        } else {
            $permisos = ['super_administrador', $permisos];
        }

        return $permisos;
    }

    /**
     * Verifica si tiene al menos 1 permiso confirmado
     *
     * @param Array $permisos
     * @return boolean
     */
    public function hasAnyPermiso($permisos)
    {
        if (is_array($permisos)) {
            foreach ($permisos as $permiso) {
                if ($this->hasPermiso($permiso)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Verifica si tiene el permiso confirmado
     *
     * @param Array $permisos
     * @return boolean
    */
    public function hasPermiso($permiso)
    {
        if ($this->role->permisos()->where('nombre', $permiso)->first()) {
            return true;
        }

        return false;
    }

    /**
     * Retorna todos los datos especificados para un usuario
     *
     * @return Array
     */
    public function getAllData()
    {
        $usuario = [];

        $usuario['id']            = $this->id;
        $usuario['username']      = $this->username;
        $usuario['email']         = $this->email;
        $usuario['image_profile'] = $this->image_profile;
        $usuario['estado']        = $this->estado;

        $usuario['empleado']         = $this->empleado;
        $usuario['rol']              = $this->role->nombre;
        $usuario['jefe_inmediato']   = $this->jefe_inmediato ? $this->jefe_inmediato->load('empleado') : [];
        $usuario['solicitud_retiro'] = $this->solicitud_retiro;
        $usuario['rutas']            = $this->getRoutesAuthorized();

        return $usuario;
    }

    /**
     * Se obtienen las rutas para mostrar los modulos correspondiente al permiso del usuario
     *
     * @return Array
     */
    public function getRoutesAuthorized()
    {
        $routes   = [];
        $permisos = $this->role->permisos;

        foreach ($permisos as $permiso) {
            array_push($routes, $permiso->ruta);
        }

        return $routes;
    }


    /**
     * Enviar la notificación de restablecimiento de contraseña.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }
}
