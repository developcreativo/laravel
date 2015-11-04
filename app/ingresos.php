<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ingresos extends Model
{
    //
    //busco la tabla ingresos
    public function getTable()
    {
        //return Session::get('tenant.id').'_ingresos';
        return 'ingresos';
    }

    protected $fillable = [
        'factura_id',
        'formas_pago_id',
        'valor'
    ];

    public function formas_pago()
    {
        return $this->belongsTo('App\formas_pago', 'formas_pago_id');
    }

    public static function AgregarIngreso($factura, $pagos)
    {

        foreach ($pagos as $pago) {
            $ingreso = new ingresos();
            if (!$factura['venta'] == "") {
                $ingreso->venta_id = $factura['venta']['id'];
            } else {
                $ingreso->venta_id = "";
            }
            if (!$factura['remision'] == "") {
                $ingreso->remision_id = $factura['remision']['id'];
            } else {
                $ingreso->remision_id = "";
            }
            $ingreso->formas_pago_id = $pago['id'];
            $ingreso->valor = $pago['valor'];

            $ingreso->save();
        }
        caja::IngresoCaja($pagos, $factura);

    }

    public static function IngresoXfactura($factura, $remision, $pago_id, $valor)
    {
        $ingreso = new ingresos();
        if ($remision == 0) {
            $ingreso->venta_id = $factura;
        } else {
            $ingreso->remision_id = $factura;
        }
        $ingreso->formas_pago_id = $pago_id;
        $ingreso->valor = $valor;
        $ingreso->save();
    }

    public static function requestXfactura($request)
    {
        foreach ($request->pagos as $pago) {
            $valor = $pago['valor'];
            foreach ($request->items as $factura) {
                $venta = ventas::find($factura['id']);
                $residual = $venta->venta - $venta->pagado;
                if ($residual == 0) {
                    continue;
                }
                if ($venta->remision == 1) {
                    $facturas[] = ['factura' => $venta->factura, 'nombre' => 'remision'];
                } else {
                    $facturas[] = ['factura' => $venta->factura, 'nombre' => 'venta'];
                }
                if ($valor <= $residual) {
                    $venta->pagado = $venta->pagado + $valor;
                    $venta->save();
                    ingresos::IngresoXfactura($venta->id, $venta->remision, $pago['id'], $valor);
                    break;
                } else {
                    $valor = $valor - $residual;
                    $venta->pagado = $venta->pagado + $residual;
                    $venta->save();
                    ingresos::IngresoXfactura($venta->id, $venta->remision, $pago['id'], $residual);
                }
            }
        }
        caja::IngresoCajaXfactura($request->pagos, $facturas);
    }

    public static function ingresoSimple($request)
    {
        foreach($request->pagos as $pago){
            $ingreso = new ingresos();
            $ingreso->formas_pago_id = $pago['id'];
            $ingreso->valor = $pago['valor'];
        }
        caja::ingresoCajaSimple($request);



    }
}
