<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class despachos extends Model
{
    //
    //busco la tabla despachos
    public function getTable()
    {
        //return Session::get('tenant.id').'_despachos';
        return 'despachos';
    }

    protected $fillable = [
        'direccion',
        'ciudad_id',
        'factura_id',
        'estado',
        'transportadora_id',
        'guia',
        'flete'

    ];

    public function factura()
    {
        return $this->hasMany('App\facturacion', 'factura_id');
    }

    public function activity()
    {
        return $this->hasMany('App\activity_despachos', 'despacho_id');
    }

    public static function crear_despacho($datos, $factura)
    {

        if ($datos->despacho == 1) {

            $despacho = new despachos();
            $despacho->direccion = $datos->direccion;
            $despacho->ciudad_id = $datos->ciudad;
            $despacho->factura_id = $factura;
            $despacho->estado = 'Por despachar';
            $despacho->save();

            $activity = new activity_despachos();
            $activity->despacho_id = $despacho->id;
            $activity->user_id = Auth::user('id');
            $activity->concepto = 'Despacho creado';
            $activity->estado = $despacho->estado;
            $activity->save();
        }
    }
}
