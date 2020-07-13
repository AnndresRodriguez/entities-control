<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    public $timestamps = false;

    public function entes()
    {
        return $this->hasMany('App\Ente');
    }

    public function dependencias()
    {
        return $this->hasMany('App\dependencia');
    }

    public function evidencias()
    {
        return $this->hasMany('App\Evidencia');
    }

    public function normativas()
    {
        return $this->hasMany('App\Normativa');
    }

    public function anios()
    {
        return $this->hasMany('App\Anio');
    }

    public function meses()
    {
        return $this->hasMany('App\Mes');
    }

    public function alarmas()
    {
        return $this->hasMany('App\Alarma');
    }
}
