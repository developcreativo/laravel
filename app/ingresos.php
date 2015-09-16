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

    public static function AgregarIngreso($factura,$pagos){
        foreach($pagos as $pago){
            $ingreso = new ingresos();
            $ingreso->venta_id = $factura['venta'];
            $ingreso->remision_id = $factura['remision'];
            $ingreso->formas_pago_id = $pago['id'];
            $ingreso->valor = $pago['valor'];
            $ingreso->save();
        }
        caja::IngresoCaja($pagos,$factura);

    }
}
