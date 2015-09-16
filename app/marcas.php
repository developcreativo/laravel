<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class marcas extends Model
{

    //

    public function getTable()
    {
        //return Session::get('tenant.id').'_marcas';
        return 'marcas';
    }
    protected $fillable = ['marca'];

    public function productos()
    {
        return $this->hasMany('App\productos','marca_id');
    }

}
