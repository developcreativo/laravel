<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

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

    static public function numero_factura($lastid)
    {
        $company = tiendas::find(Session::get('tenant.id'));
        if (!$lastid['venta'] == "") {
            $company->factura = $lastid['venta']['factura'];
        }
        if (!$lastid['remision'] == "") {
            $company->remision = $lastid['remision']['factura'];
        }
        $company->save();
    }

}
