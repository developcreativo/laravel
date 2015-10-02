<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transportadoras extends Model
{
    //
    //busco la tabla transportadoras
    public function getTable()
        {
            //return Session::get('tenant.id').'_transportadoras';
            return 'transportadoras';
        }
    protected $fillable = [
            'transportadora',
            'contacto',
            'telefono',
            'email',

        ];
}
