<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /**
     * Los atributos que son asignables.
     *
     * @var array
     */
    protected $filliable = [
        'documento', 
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'genero',
        'cargo'
    ];


    /**
     * Atributo obtenido para acortar nombre
     *
     * @var array
     */
    protected $appends = ['nombre_corto'];


    /**
     * Metodo para acceder a la relacion del modelo empleado con el modelo role
     * 
     * @return Object role
     */

    public function user(){
    	return $this->hasOne(Role::class);
    }
    /**
     * Funcion para asignar valor a @var $appends
     * 
     * @return Array
     */
    public function getNombreCortoAttribute()
    {
        $nombres   = explode(' ', $this->nombres);
        $apellidos = explode(' ', $this->apellidos);

        return $this->attributes['nombre_corto'] = $nombres[0] .' '. $apellidos[0];
    }

    /** 
     * Funcion para obtener el nombre corto del empleado
     * 
     * @return String
    */
    public function nombreCorto()
    {
        $nombres   = explode(' ', $this->nombres);
        $apellidos = explode(' ', $this->apellidos);

        return($nombres[0] .' '. $apellidos[0]);
    }

    /** 
     * Funcion para obtener el nombre completo del empleado
     * 
     * @return String
    */
    public function nombreCompleto()
    {
        return $this->nombres .' '. $this->apellidos;
    }

    /**
     * Retorna todos los datos especificados para un empleado
     * 
     * @return Array
     */
    public function getAllData()
    {
        $empleado = [];

        $empleado['id']               = $this->id;
        $empleado['documento']        = $this->documento;
        $empleado['nombres']          = $this->nombres;
        $empleado['apellidos']        = $this->apellidos;
        $empleado['fecha_nacimiento'] = $this->fecha_nacimiento;
        $empleado['genero']           = $this->genero;
        $empleado['cargo']            = $this->cargo;
        $empleado['estado']           = $this->estado;

        return $empleado;
    }

}
