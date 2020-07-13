<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarma extends Model
{
    public $timestamps = false;

    public function anios()
    {
        return $this->hasMany('App\Anio');
    }

    public function meses()
    {
        return $this->hasMany('App\Mes');
    }

    public function dias()
    {
        return $this->hasMany('App\Dia');
    }

    public function informe()
    {
        return $this->belongsTo('App\Informe');
    }
}
