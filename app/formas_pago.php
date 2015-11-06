<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formas_pago extends Model
{
    //
    //busco la tabla formas_pago
    public function getTable()
        {
            //return Session::get('tenant.id').'_formas_pago';
            return 'formas_pago';
        }

    protected $fillable = [
            'forma_pago',
            'comision'

        ];

    public function cuenta_bancaria()
    {
        return $this->belongsTo('App\cuentas_bancarias', 'cuenta_bancaria_id');
    }
}
