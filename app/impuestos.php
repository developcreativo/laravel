<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class impuestos extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_impuestos';
        return 'impuestos';
    }
    protected $fillable = ['impuesto','valor'];

    public function productos()
    {
        return $this->hasMany('App\productos');
    }
}
