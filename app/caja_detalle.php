<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caja_detalle extends Model
{
    //
    //busco la tabla caja_detalle
    public function getTable()
        {
            //return Session::get('tenant.id').'_caja_detalle';
            return 'caja_detalle';
        }

    protected $fillable = [
        'caja_id',
        'formas_pago_id',
        'concepto',
        'valor'
    ];
}
