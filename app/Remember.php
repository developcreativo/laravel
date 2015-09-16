<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Remember extends Model
{
    //
    public static function recordar($titulo, $otro)
    {
        if (Cache::has($titulo)) {
            //
             return Cache::get($titulo);
        }else{
            Cache::put($titulo, $otro, 60);
            return $otro;
        }

    }


}
