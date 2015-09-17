<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ventas extends Model
{
    //
    //busco la tabla ventas
    public function getTable()
    {
        //return Session::get('tenant.id').'_ventas_'.Session::get('bodega');
        return 'ventas_' . Session::get('bodega');
    }

    protected $fillable = [
        'cliente_id',
        'tienda_id',
        'user_id',
        'pagado',
        'venta',
        'iva',
        'plazo'
    ];

    public function facturas()
    {
        return $this->hasMany('App\facturacion', 'venta_id');
    }

    public function venta_detalle()
    {
        return $this->hasmany('App\venta_detalle', 'venta_id');
    }

    public function clientes()
    {
        return $this->belongsTo('App\clientes', 'cliente_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tiendas()
    {
        return $this->belongsTo('App\tiendas', 'tienda_id');
    }

    public static function separador_remision($datos)
    {
        $items = $datos['items']; //obtengo los datos de los productos
        $j = 0;
        $i = 0;
        //separo los prodcutos a facturar y los de remision
        foreach ($items as $item) {
            if ($item['remision'] == 0) {
                $items_venta[] = $item;
                $i = 1;
            } else {
                $items_remision[] = $item;
                $j = 1;
            }
        }
        if ($j > 0) {
            //si tengo productos de remision los agrego y me traigo el id
            $lastid['remision'] = ventas::agregar_remision($datos, $items_remision);
        }
        if ($i > 0) {
            //si tengo productos de facturar los agrego y me traigo el id
            $lastid['venta'] = ventas::agregar_venta($datos, $items_venta);
        }
        if (!isset($lastid['venta'])) {
            $lastid['venta'] = "";
        }
        if (!isset($lastid['remision'])) {
            $lastid['remision'] = "";
        }
        return $lastid;
    }

    public static function agregar_remision($datos, $items_remision)
    {
        $total = 0;
        $iva = 0;
        $valor = 0;
        foreach ($items_remision as $item) {
            $total += $item['valor'];
            $iva += $item['iva'];
        }
        foreach ($datos['pagos'] as $pago) {
            $valor += $pago['valor'];
            if($pago['id'] == 6){
                $valor = 0;
            }
        }
        $factura = tiendas::find(Session::get('bodega'))->remision + 1;
        $venta = new ventas();
        $venta->factura = $factura;
        $venta->remision = 1;
        $venta->cliente_id = $datos['cliente_id'];
        $venta->tienda_id = Session::get('bodega');
        $venta->user_id = $datos['user_id'];
        $venta->venta = $total;
        $venta->iva = $iva;
        if ($total == $valor) {
            $venta->pagado = 1;
        } else {
            $venta->pagado = 0;
        }
        $venta->save();
        venta_detalle::AgregarVentaDetalle($items_remision, $venta->id);

        return ['id'=>$venta->id,'factura'=>$venta->factura];
    }

    public static function agregar_venta($datos, $items_venta)
    {
        $total = 0;
        $iva = 0;
        $valor = 0;
        foreach ($items_venta as $item) {
            $total += $item['valor'];
            $iva += $item['iva'];
        }
        foreach ($datos['pagos'] as $pago) {
            $valor += $pago['valor'];
            if($pago['id'] == 6){
                $valor = 0;
            }
        }
        $factura = tiendas::find(Session::get('bodega'))->factura + 1;
        $venta = new ventas();
        $venta->factura = $factura;
        $venta->remision = 0;
        $venta->cliente_id = $datos['cliente_id'];
        $venta->tienda_id = Session::get('bodega');
        $venta->user_id = $datos['user_id'];
        $venta->venta = $total;
        $venta->iva = $iva;
        if ($total == $valor) {
            $venta->pagado = 1;
        } else {
            $venta->pagado = 0;
        }
        $venta->save();
        venta_detalle::AgregarVentaDetalle($items_venta, $venta->id);

        return ['id'=>$venta->id,'factura'=>$venta->factura];
    }

    public static function crear_pdf($id)
    {
        $tipo = facturacion::find($id);
        $venta = ventas::with('venta_detalle.productos_configurables', 'clientes', 'tiendas.company', 'user')
            ->find($tipo->venta_id);
        $view = view('app/ventas/ventas_pos_invoice', compact('venta'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf;
    }
}
