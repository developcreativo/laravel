<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activity_despachos extends Model
{
    //
    //busco la tabla activity_despachos
    public function getTable()
        {
            //return Session::get('tenant.id').'_activity_despachos';
            return 'activity_despachos';
        }
    protected $fillable = [
            'despacho_id',
            'concepto',
            'estado',
            'user_id'

        ];
    public function despachos()
    {
        return $this->belongsTo('App\despachos', 'despacho_id');
    }
}
