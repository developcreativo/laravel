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
        'compra',
        'subtotal',
        'retefuente',
        'iva',
        'descuento',
        'vencimiento'
    ];

    public function factura_venta()
    {
        return $this->hasOne('App\facturacion', 'venta_id');
    }

    public function factura_remision()
    {
        return $this->hasOne('App\facturacion', 'remision_id');
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

    public function ingreso_venta()
    {
        return $this->hasMany('App\ingresos', 'venta_id');
    }

    public function ingreso_remision()
    {
        return $this->hasMany('App\ingresos', 'remision_id');
    }

    public static function separador_remision($datos)
    {
        //crear cliente
        if ($datos['cliente_id'] == "") {
            clientes::create($datos->all());
        }
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
        $compra = 0;
        $descuento = 0;
        $subtotal = 0;
        foreach ($items_remision as $item) {
            $dto = ($item['dto'] / 100) * $item['valor'] * $item['cantidad'] || 0;
            $iva += ($item['iva'] / 100) * (($item['valor'] * $item['cantidad']) - $dto) || 0;
            $subtotal += ($item['valor'] * $item['cantidad']);
            $compra += $item['compra'] * $item['cantidad'];
        }
        foreach ($datos['pagos'] as $pago) {
            $valor += $pago['valor'];
            if ($pago['id'] == 6) {
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
        $venta->venta = $subtotal - $descuento + $iva;
        $venta->subtotal = $subtotal;
        $venta->retefuente = $datos['retefuente'];
        $venta->iva = $iva;
        $venta->descuento = $descuento;
        $venta->compra = $compra;
        if ($valor > 0) {
            $venta->pagado = 1;
        } else {
            $venta->pagado = 0;
        }
        $venta->save();
        venta_detalle::AgregarVentaDetalle($items_remision, $venta->id);

        return ['id' => $venta->id, 'factura' => $venta->factura];
    }

    public static function agregar_venta($datos, $items_venta)
    {
        $total = 0;
        $iva = 0;
        $valor = 0;
        $compra = 0;
        $descuento = 0;
        $subtotal = 0;
        foreach ($items_venta as $item) {
            $dto = ($item['dto'] / 100) * $item['valor'] * $item['cantidad'];
            $iva += ($item['iva'] / 100) * (($item['valor'] * $item['cantidad']) - $dto);
            $subtotal += ($item['valor'] * $item['cantidad']);
            $compra += $item['compra'] * $item['cantidad'];
            $descuento += $dto;
        }
        foreach ($datos['pagos'] as $pago) {
            if ($pago['id'] == 6) {
                $valor += 0;
            } else {
                $valor += $pago['valor'];
            }
        }
        if ($descuento == 0) {
            $descuento = $datos['descuento'];
        }
        $factura = tiendas::find(Session::get('bodega'))->factura + 1;
        $venta = new ventas();
        $venta->factura = $factura;
        $venta->remision = 0;
        $venta->cliente_id = $datos['cliente_id'];
        $venta->tienda_id = Session::get('bodega');
        $venta->user_id = $datos['user_id'];
        $venta->venta = $subtotal - $descuento + $iva;
        $venta->subtotal = $subtotal;
        $venta->retefuente = $datos['retefuente'];
        $venta->iva = $iva;
        $venta->descuento = $descuento;
        $venta->compra = $compra;
        if ($valor > 0) {
            $venta->pagado = 1;
        } else {
            $venta->pagado = 0;
        }
        $venta->save();
        venta_detalle::AgregarVentaDetalle($items_venta, $venta->id);

        return ['id' => $venta->id, 'factura' => $venta->factura];
    }

    public static function crear_pdf($id)
    {
        $venta = ventas::with('venta_detalle.productos_configurables', 'clientes',
            'tiendas.company', 'user', 'ingreso_venta.formas_pago')->find($id);
        $cuenta = cuentas_bancarias::where('principal', 1)->first();
        $view = view('app/ventas/ventas_pdf', compact('venta', 'cuenta'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf;
    }
}
