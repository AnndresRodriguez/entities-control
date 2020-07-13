<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dependencia extends Model
{
    public $timestamps = false;

    public function informe()
    {
        return $this->belongsTo('App\Informe');
    }
}
