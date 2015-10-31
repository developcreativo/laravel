<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caja_detalle extends Model
{
    //
    //busco la tabla caja_detalle
    public function getTable()
        {
            //return Session::get('tenant.id').'_caja_detalle';
            return 'caja_detalle';
        }

    protected $fillable = [
        'caja_id',
        'formas_pago_id',
        'concepto',
        'valor'
    ];

    public function pagos()
    {
        return $this->belongsTo('App\formas_pago', 'formas_pago_id');
    }

    public function tipo_movimientos()
    {
        return $this->belongsTo('App\tipo_movimiento', 'tipo_movimiento');
    }

    public static function movimiento($id,$concepto,$forma_pago,$valor,$tipo)
    {
        $item = new caja_detalle();
        $item->caja_id = $id;
        $item->formas_pago_id = $forma_pago;
        $item->concepto = $concepto;
        $item->valor = $valor;
        $item->tipo_movimiento = $tipo;
        $item->save();

    }




}
