<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Sesion;

use Session;

trait SesionTrait
{

    
    /**
     * Este metodo registrar el inicio de sesion de un usuario al aplicativo
     * 
     * @param String $ip
     * @return int 
     */
    public function registrarInicioDeSesion($ip)
    {
        $sesion = new Sesion();
        $sesion->user_id   = auth()->user()->id;
        $sesion->inicio    = \date('Y-m-d H:i:s');
        $sesion->finalizo  = \date('Y-m-d H:i:s');
        $sesion->duracion  = $this->diferencia_de_fechas($sesion->inicio, $sesion->finalizo);
        $sesion->ip        = $ip;
        $sesion->save();

        return $sesion->id;
    }


    /**
     * Este metodo obtiene la diferencia entre dos fecha
     * 
     * @param date $inicio
     * @param date $final
     * @return int
     */ 
    
    public function diferencia_de_fechas($inicio, $final)
    {
        $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $inicio);
        $final  = Carbon::createFromFormat('Y-m-d H:i:s', $final);

        return $inicio->diffInSeconds($final);
    }


    /* 
    *   
    */
    /**
     * Este metodo obtiene la ip del usuario
     * 
     * @return void
     */
    public function get_real_ip()
    {
      if (!empty($_SERVER["HTTP_CLIENT_IP"]))
      return $_SERVER["HTTP_CLIENT_IP"];
      if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
      return $_SERVER["HTTP_X_FORWARDED_FOR"];
      return $_SERVER["REMOTE_ADDR"];
    }


    /**
     *  Este metodo actualiza el tiempo de la duracion de la sesion del usuario en al aplicativo
     * 
     *  @return boolean
     */
    public function actualizarDuracionDeLaSesion()
    {
        $sesion_id = Session::get('id_sesion');

        $sesion = Sesion::find($sesion_id);
        
        if($sesion) {
            $sesion->finalizo  = \date('Y-m-d H:i:s');
            $sesion->inicio    = $sesion->inicio;
            $sesion->duracion  = $this->diferencia_de_fechas($sesion->inicio, $sesion->finalizo);
            $sesion->save();
        }

        return true;
    }

}