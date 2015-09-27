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
            'ciudad_id',
            'direccion',
            'deuda_maxima',

        ];

    public function ciudad(){
        return $this->belongsTo('App\ciudades','ciudad_id');
    }


}
