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

    public function formas_pago(){
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
}
