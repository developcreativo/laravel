<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tiendas extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_tiendas';
        return 'tiendas';
    }

    protected $fillable = [
        'tienda',
        'nit',
        'prefijo',
        'telefono',
        'direccion',
        'ciudad_id',
        'resolucion_dian',
        'fecha_dian',
        'rango',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\company', 'company_id');
    }

}
