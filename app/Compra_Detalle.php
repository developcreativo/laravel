<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra_Detalle extends Model
{
    //
    //busco la tabla compra_detalle
    public function getTable()
        {
            //return Session::get('tenant.id').'_compra_detalle';
            return 'compra_detalle';
        }

    protected $fillable = [
        'compra_id',
        'producto_configurable_id',
        'cantidad',
        'valor',
        'dto',
        'iva'

    ];
    public function producto_configurable()
    {
        return $this->belongsTo('App\productos_configurables','producto_configurable_id');
    }

    public static function AgregarCompraDetalle($items,$id)
    {
        foreach($items as $item) {
            $producto= new compra_detalle();
            $producto->compra_id = $id;
            $producto->producto_configurable_id = $item['producto_configurable'];
            $producto->cantidad = $item['cantidad'];
            $producto->valor = ($item['sub_total'])/($item['cantidad']);
            $producto->dto = (($item['dto']/100)*$item['valor']);
            $producto->iva = (($item['iva']/100)*($item['valor']-$producto->dto));
            $producto->sub_total = $item['sub_total'];
            $producto->save();



        }

    }
}
