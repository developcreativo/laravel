<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Bodegas extends Model
{
    //busco la tabla bodegas
    public function getTable()
    {
        //return Session::get('tenant.id').'_bodegas_'.Session::get('bodega');
        return 'bodegas_' . Session::get('bodega');
    }

    public function productos_configurables()
    {
        return $this->belongsTo('App\productos_configurables', 'codigo');
    }

    //agregar productos a bodega de una compra
    public static function AgregarCompra($items, $remision)
    {
        foreach ($items as $item) {
            //busco si el producto ya est� en la bodega con las mismas caracteristicas//
            $producto = Bodegas::where('codigo', $item['producto_configurable'])->where('remision', $remision)->first();
            //si encuentro un producto edito la informacion si no creo uno//
            if (isset($producto)) {
                $cantidad = $producto->cantidad + $item['cantidad'];
                if ($cantidad > 0) {
                    $producto->compra = (($producto->cantidad * $producto->compra) + $item['sub_total']) / $cantidad;
                } else {
                    $producto->compra = $item['sub_total'] / $cantidad;
                }
                $producto->cantidad = $producto->cantidad + $item['cantidad'];
                $producto->update();

            } else {
                $producto = new Bodegas();
                $producto->codigo = $item['producto_configurable'];
                $producto->cantidad = $item['cantidad'];
                $producto->compra = ($item['sub_total'] / $item['cantidad']);
                $producto->iva = $item['iva'] / 100;
                $producto->remision = $remision;
                $producto->save();
            }

            $SKU = productos_configurables::find($item['producto_configurable']);
            $padre = productos::find($SKU->producto_id);
            $padre->compra = $producto->compra;
            $padre->rentabilidad = (1 - ($producto->compra / $padre->venta)) * 100;
            $padre->update();
            //agregar precio al historico
            $producto = new Historico_Compras();
            $producto->codigo = $padre->id;
            $producto->precio = ($item['sub_total']) / ($item['cantidad']);
            $producto->save();

        }
    }


    //descuenta la cantidad de productos de la bodega y si esta en 0 la elimina
    public static function Agregar_Venta($items)
    {
        foreach ($items as $item) {
            $compra = $item['compra'];
            $id = $item['id'];
            $remision = $item['remision'];
            $producto = Bodegas::where('codigo', $id)->where('compra', $compra)->where('remision', $remision)->first();
            $cantidad = $producto->cantidad - $item['cantidad'];
            //adicion para que se pueda facturar cantidades negativas
            $producto->cantidad = $cantidad;
            $producto->save();
            /*if ($cantidad == 0) {
                $producto->delete();
            } else {
                $producto->cantidad = $cantidad;
                $producto->save();
            }*/
        }

    }

    //crear funcion para cuando se elimine un sabor o producto para eliminarlo en cada uno de las bodegas
}
