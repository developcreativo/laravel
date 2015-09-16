<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class facturacion extends Model
{
    //
    //busco la tabla facturacion
    public function getTable()
        {
            //return Session::get('tenant.id').'_facturacion_' . Session::get('bodega');
            return 'facturacion_' . Session::get('bodega');
        }

    protected $fillable = [
        'venta_id',
        'remision_id'
    ];

    public function ventas()
    {
        return $this->belongsTo('App\ventas', 'venta_id', 'id');
    }

    public function remision()
    {
        return $this->belongsTo('App\remision', 'remision_id', 'id');
    }
    public function ingresos()
    {
        return $this->hasmany('App\ingresos','factura_id');
    }

    public static function AgregarFacturacion($id)
    {
        $factura = new facturacion();
        $factura->venta_id = $id['venta'];
        $factura->remision_id = $id['remision'];
        $factura->save();
        $factura_id = $factura->id;
        return $factura_id;
    }
}
