<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    //
    //busco la tabla clientes
    public function getTable()
        {
            //return Session::get('tenant.id').'_clientes';
            return 'clientes';
        }
    protected $fillable = [
            'documento',
            'cliente',
            'email',
            'telefono',
            'direccion',
            'deuda_maxima',

        ];

}
