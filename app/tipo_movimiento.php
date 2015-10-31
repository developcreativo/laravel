<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_movimiento extends Model
{
    //
    //busco la tabla tipo_movimiento
    public function getTable()
        {
            //return Session::get('tenant.id').'_tipo_movimiento';
            return 'tipo_movimiento';
        }
}
