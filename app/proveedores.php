<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_proveedores';
        return 'proveedores';
    }
    protected $fillable = [
        'proveedor',
        'nit',
        'contacto',
        'email',
        'telefono',
        'web',

    ];
    public function compras()
    {
        return $this->hasMany('App\compras','proveedor_id');
    }
}
