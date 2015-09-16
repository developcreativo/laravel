<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atributos extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_atributos';
        return 'atributos';
    }
    protected $fillable = [

    ];
    public function atributos_sub()
    {
        return $this->hasMany('App\atributos_sub','atributo_id');
    }
}
