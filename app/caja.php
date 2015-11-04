<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class caja extends Model
{
    //
    //busco la tabla caja
    public function getTable()
    {
        //return Session::get('tenant.id').'_caja';
        return 'caja';
    }

    protected $fillable = [
        'tienda_id',
        'apertura',
        'cierre',
        'estado',
        'descuadre',
        'nota',
        'user_id'
    ];

    public function tiendas()
    {
        return $this->belongsTo('App\tiendas', 'tienda_id');
    }

    public function usuarios()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function IngresoCaja($ingresos, $factura)
    {

        $caja = caja::CajaAbierta();
        foreach ($ingresos as $ingreso) {
            if (!$factura["venta"] == "") {
                $concepto = 'la factura ' . $factura["venta"]['factura'];
            } else {
                $concepto = 'la remision ' . $factura["remision"]['factura'];
            }
            if (!$factura["venta"] == "" and !$factura["remision"] == "") {
                $concepto = 'la factura ' . $factura["venta"]['factura'] . ' y la remision ' . $factura["remision"]['factura'];
            }
            $concepto = 'pago de ' . $concepto . ' en ' . $ingreso['pago'];

            switch ($ingreso['id']) {
                case 1:
                    $tipo_movimiento = 2;
                    break;
                case 6:
                    $tipo_movimiento = 4;
                    break;
                default:
                    $tipo_movimiento = 3;
                    break;
            }

            caja_detalle::movimiento($caja->id, $concepto, $ingreso['id'], $ingreso['valor'], $tipo_movimiento);

        }

    }

    public static function ingresoCajaSimple($request){
        $caja = caja::CajaAbierta();
        foreach($request->pagos as $pago){
            switch ($pago['id']) {
                case 1:
                    $tipo_movimiento = 2;
                    break;
                case 6:
                    $tipo_movimiento = 4;
                    break;
                default:
                    $tipo_movimiento = 3;
                    break;
            }
            $concepto = $request->concepto. ' forma de pago '. $pago['pago'];
            caja_detalle::movimiento($caja->id, $concepto, $pago['id'], $pago['valor'], $tipo_movimiento);

        }
    }

    public static function IngresoCajaXfactura($ingresos, $facturas)
    {

        $caja = caja::CajaAbierta();
        foreach ($ingresos as $ingreso) {
            $concepto = 'pago de';
            foreach ($facturas as $factura) {
                $concepto = $concepto . ' la ' . $factura['nombre'] . ' #' . $factura['factura'] . ',';
            }
            $concepto = $concepto . ' en ' . $ingreso['pago'];

            switch ($ingreso['id']) {
                case 1:
                    $tipo_movimiento = 2;
                    break;
                case 6:
                    $tipo_movimiento = 4;
                    break;
                default:
                    $tipo_movimiento = 3;
                    break;
            }
            caja_detalle::movimiento($caja->id, $concepto, $ingreso['id'], $ingreso['valor'], $tipo_movimiento);
        }
    }

    public static function EgresoCaja($egresos)
    {
        $caja = caja::CajaAbierta();
        foreach ($egresos as $egreso) {
            $item = new caja_detalle();
            $item->caja_id = $caja->id;
            $item->tipo = 'egreso';
            $item->nombre = 'efectivo';
            $item->valor = $egreso['valor'];
            $item->save();
        }
    }

    public static function AbrirCaja($ingreso, $nota)
    {

        $caja = caja::CajaAbierta();
        if (isset($caja)) {
            Session::put('caja', 'caja ya esta abierta');
        } else {
            $caja = new caja();
            $caja->tienda_id = Auth::user()->tienda_id;
            $caja->estado = '1';
            $caja->apertura = caja::SaldoAnterior($ingreso);
            $caja->nota_apertura = $nota . ', ' . Session::get('saldo');
            $caja->user_id = Auth::user()->id;
            $caja->save();
            $concepto = 'apertura de caja';

            //ingresar el movimiento de apertura de caja con su valor
            caja_detalle::movimiento($caja->id, $concepto, 1, $caja->apertura, 1);
            Session::put('caja', 'caja Abierta correctamente');
        }
        return $caja;
    }

    public static function CerrarCaja($ingreso, $nota)
    {
        $caja = caja::CajaAbierta();
        if (isset($caja)) {
            $item = caja::find($caja->id);
            $item->estado = '0';
            $cierre = caja::Totales($caja->id);
            if ($cierre['Saldo'] <> $ingreso) {
                $item->nota_cierre = $nota . ', ' . 'Cierre tiene descuadre';
                $item->descuadre = 1;
            } else {
                $item->nota = $nota;
                $item->descuadre = 0;
            }
            $item->cierre = $ingreso;
            $item->save();
        } else {
            Session::put('caja', 'caja ya esta abierta');
        }
    }

    public static function Totales($id)
    {

        $movimientos = caja_detalle::with('tipo_movimientos')->where('caja_id', $id)->groupBy('tipo_movimiento')
            ->selectraw('*, sum(valor) as Suma')->get();

        foreach ($movimientos as $movimiento) {

            if ($movimiento->tipo_movimiento == 1) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            } elseif ($movimiento->tipo_movimiento == 2) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            } elseif ($movimiento->tipo_movimiento == 3) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            } elseif ($movimiento->tipo_movimiento == 4) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            } elseif ($movimiento->tipo_movimiento == 5) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            } elseif ($movimiento->tipo_movimiento == 6) {
                $totales[$movimiento->tipo_movimientos->tipo_movimiento] = $movimiento->Suma;
            }
            if (!isset($totales['Efectivo'])) {
                $totales['Efectivo'] = 0;
            }
            if (!isset($totales['Apertura'])) {
                $totales['Apertura'] = 0;
            }
            if (!isset($totales['Egreso'])) {
                $totales['Egreso'] = 0;
            }
            if (!isset($totales['Crédito'])) {
                $totales['Crédito'] = 0;
            }
            if (!isset($totales['Tarjeta'])) {
                $totales['Tarjeta'] = 0;
            }
        };

        $totales['Saldo'] = $totales['Apertura'] + $totales['Efectivo'] - ($totales['Egreso']);
        return $totales;
    }

    public static function SaldoAnterior($valor)
    {

        $caja = caja::where('tienda_id', Auth::user()->tienda_id)->where('estado', '0')
            ->orderBy('id', 'desc')->first();

        if (isset($caja)) {
            if ($caja->cierre == $valor) {
                Session::put('saldo', '- Apertura de caja Cuadra');
            } else {
                Session::put('saldo', 'Apertura de caja tiene un descuadre de ' . ($valor - $caja->cierre));
            }
        } else {
            Session::put('saldo', '- Apertura de caja Cuadra');
        }
        return $valor;

    }

    public static function CajaAbierta()
    {
        $tienda = Auth::user()->tienda_id;
        $caja = (caja::where('tienda_id', $tienda)->where('estado', '1')->first());
        return $caja;
    }
}
