<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuentas_bancarias extends Model
{
    //
    //busco la tabla cuentas_bancarias
    public function getTable()
        {
            //return Session::get('tenant.id').'_cuentas_bancarias';
            return 'cuentas_bancarias';
        }
    protected $fillable = [
        'banco',
        'cuenta',
        'tipo',
        'titular',
        'documento',
        'principal'
    ];
}
