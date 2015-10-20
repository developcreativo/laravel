<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ciudades extends Model
{
    //
    protected $table = 'ciudades';
    public function departamentos(){
        return $this->belongsTo('App\departamentos','departamento_id');
    }

}
