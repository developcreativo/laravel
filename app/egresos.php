<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class egresos extends Model
{
    //
    //busco la tabla egresos
    public function getTable()
    {
        //return Session::get('tenant.id').'_egresos';
        return 'egresos';
    }

    protected $fillable = [
        'column1',
        'column1'

    ];
    public function formas_pago()
    {
        return $this->belongsTo('App\formas_pago', 'formas_pago_id');
    }


    public static function egresoXcompra($request, $id, $caja_id)
    {
        $total = 0;
        foreach ($request->pagos as $pago) {
            $egreso = new egresos();
            $egreso->compra_id = $id;
            $egreso->formas_pago_id = $pago['id'];
            $egreso->valor = $pago['valor'];
            $egreso->save();
            $total += $pago['valor'];
        }
        $compra = compras::find($id);
        $compra->pagado = $compra->pagado + $total;
        $compra->save();
        caja::EgresoXfactura($request->pagos,$caja_id,$compra->factura);
    }
}
