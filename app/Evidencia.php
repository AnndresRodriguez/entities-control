<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    public $timestamps = false;

    public function informe()
    {
        return $this->belongsTo('App\Informe');
    }
}
