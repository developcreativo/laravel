<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atributos_sub extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_atributos_sub';
        return 'atributos_sub';
    }
    protected $fillable = [

    ];
    public function atributos(){
        return $this->belongsTo('App\atributos','atributo_id');
    }
    public function productos_configurables(){
        return $this->hasMany('App\productos_configurables');
    }

}
