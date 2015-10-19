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

    public static function IngresoCaja($ingresos,$factura)
    {

        $caja = caja::CajaAbierta();
        foreach($ingresos as $ingreso){
            if(!$factura["venta"] == ""){
                $concepto = 'la factura '.$factura["venta"]['factura'];
            }else{
                $concepto = 'la remision '.$factura["remision"]['factura'];
            }
            if(!$factura["venta"] == "" and !$factura["remision"] == ""){
                $concepto = 'la factura '.$factura["venta"]['factura'].' y la remision '.$factura["remision"]['factura'];
            }

            $item = new caja_detalle();
            $item->caja_id = $caja->id;
            $item->formas_pago_id = $ingreso['id'];
            $item->concepto = 'pago de '.$concepto.' por valor de '.$ingreso['pago'];
            $item->valor = $ingreso['valor'];
            $item->save();
        }
        Session::flash('mensaje','ingreso a caja exitoso');
    }
    public static function EgresoCaja($egresos)
    {
        $caja = caja::CajaAbierta();
        foreach($egresos as $egreso){
            $item = new caja_detalle();
            $item->caja_id = $caja->id;
            $item->tipo = 'egreso';
            $item->nombre = 'efectivo';
            $item->valor = $egreso['valor'];
            $item->save();
        }
    }
    public static function AbrirCaja()
    {
        $caja = caja::CajaAbierta();
        if($caja->count()){
            return $mensaje = 'caja ya esta abierta';
        }else{
            $item = new caja();
            $item->tienda_id = Auth::user()->tienda_id;
            $item->estado = '1';
            $item->apertura = caja::SaldoAnterior();
            $item->save();
            return $apertura = $item->apertura;
        }
    }
    public static function CerrarCaja()
    {
        $caja = caja::CajaAbierta();
        if(isset($caja)){
            $item = caja::find($caja->id);
            $item->estado = '0';
            $item->cierre = caja::Totales($caja->id);
            $item->save();
        }else{
            return $mensaje = 'caja ya esta cerrada';
        }
    }
    public function Totales($caja)
    {
        $ingreso = caja_detalle::where('caja_id','=', $caja)->where('tipo','=','ingreso')->groupBy('nombre')->get();

    }
    public static function SaldoAnterior()
    {
        $tienda = Auth::user()->tienda_id;
        $caja = caja::where('tienda_id', '=', $tienda)->where('estado', '=', '0')->orderBy('id', 'desc')->first();
        if(isset($caja)){
            return $caja->cierre;
        }else{
            return '0';
        }

    }
    public static function CajaAbierta()
    {
        $tienda = Auth::user()->tienda_id;
        $caja = (caja::where('tienda_id', '=', $tienda)->where('estado', '=', '1')->first() );
        return $caja;
    }
}
