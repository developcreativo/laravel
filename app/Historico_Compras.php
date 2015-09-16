<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico_Compras extends Model
{
    //
    //busco la tabla historico_compras
    public function getTable()
        {
            //return Session::get('tenant.id').'_historico_compras';
            return 'historico_compras';
        }
}
