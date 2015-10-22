<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class venta_detalle extends Model
{
    //
    //busco la tabla venta_detalle
    public function getTable()
    {
        //return Session::get('tenant.id').'_venta_detalle_'.Session::get('bodega');
        return 'venta_detalle_'.Session::get('bodega');
    }

    protected $fillable = [
        'venta_id',
        'producto_configurable_id',
        'cantidad',
        'venta',
        'compra',
        'subtotal',
        'iva',
        'dto'
    ];

    public function productos_configurables()
    {
        return $this->belongsTo('App\productos_configurables', 'producto_configurable_id');
    }

    public function ventas()
    {
        return $this->belongsTo('App\ventas', 'venta_id');
    }

    public static function AgregarVentaDetalle($items, $id)
    {
        foreach ($items as $item) {
            $producto = new venta_detalle();
            $producto->venta_id = $id;
            $producto->producto_configurable_id = $item['id'];
            $producto->producto = $item['nombre'];
            $producto->cantidad = $item['cantidad'];
            $producto->venta = ($item['valor']);
            $producto->compra = ($item['compra']);
            $producto->subtotal = $item['sub_total'];
            $producto->iva = $item['iva'];
            $producto->dto = $item['dto'];
            $producto->save();
        }
    }
}
