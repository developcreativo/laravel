<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos_configurables extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_productos_configurables';
        return 'productos_configurables';
    }

    protected $fillable = [
        'producto',
        'variable_1',
        'variable_2',
        'producto_id'
    ];

    public function productos()
    {
        return $this->belongsTo('App\productos', 'producto_id');
    }

    public function variable1()
    {
        return $this->belongsTo('App\atributos_sub', 'variable_1');
    }

    public function variable2()
    {
        return $this->belongsTo('App\atributos_sub', 'variable_2');
    }


    public static function crear($request, $id)
    {

        if (is_array($request->variables_1)) {
            foreach ($request->variables_1 as $variable_1) {
                $v1 = atributos_sub::find($variable_1);
                if (is_array($request->variables_2)) {
                    foreach ($request->variables_2 as $variable_2) {
                        $v2 = atributos_sub::find($variable_2);
                        $nombre1 = $request->producto . ' - ' . $v1->variable . ' - ' . $v2->variable;
                        $nombre2 = productos_configurables::where('producto_id', '=', $id)
                            ->where('variable_1', '=', $v1->id)
                            ->where('variable_2', '=', $v2->id)->first();
                        if (!isset($nombre2)) {
                            $producto = new productos_configurables();
                            $producto->producto = $nombre1;
                            $producto->variable_1 = $v1->id;
                            $producto->variable_2 = $v2->id;
                            $producto->producto_id = $id;
                            $producto->save();
                        }

                    }
                } else {

                    $nombre1 = $request->producto . ' - ' . $v1->variable;
                    $nombre2 = productos_configurables::where('producto_id', '=', $id)
                        ->where('variable_1', '=', $v1->id)->first();
                    if (!isset($nombre2)) {
                        $producto = new productos_configurables();
                        $producto->producto = $nombre1;
                        $producto->variable_1 = $v1->id;
                        $producto->producto_id = $id;
                        $producto->save();
                    }
                }
            }
        } else {
            $nombre1 = $request->producto;
            $nombre2 = productos_configurables::where('producto_id', '=', $id)->first();
            if (!isset($nombre2)) {
                $producto = new productos_configurables();
                $producto->producto = $nombre1;
                $producto->producto_id = $id;
                $producto->save();
            }

        }

    }

    public static function variables($variables, $producto)
    {
        if (!$variables->isEmpty()) {
            $lista_variable1 = atributos_sub::where('atributo_id', '=', $producto->atributo_1)->lists('variable', 'id')->toArray();
            if($producto->atributo_2 >0){
                $lista_variable2 = atributos_sub::where('atributo_id', '=', $producto->atributo_2)->lists('variable', 'id')->toArray();
            }else{
                $lista_variable2[] = '';
            }

            foreach ($variables as $variable) {
                $variable1[] = $variable->variable_1;
                $variable2[] = $variable->variable_2;
            };
        } else {
            $variable1 = '';
            $variable2 = '';
            $lista_variable1[] = '';
            $lista_variable2[] = '';
        };
        return array('variable1' => $variable1, 'variable2' => $variable2, 'lista_variable1' => $lista_variable1, 'lista_variable2' => $lista_variable2);
    }

    public static function eliminar($request, $id)
    {
        if (is_array($request->variables_1)) {
            $productos = productos_configurables::where('producto_id', '=', $id)->lists('variable_1')->toarray();
            if (count($request->variables_1) < count($productos)) {
                $resultados = array_diff($productos, $request->variables_1);
                foreach ($resultados as $resultado) {
                    $producto = productos_configurables::where('producto_id', '=', $id)
                        ->where('variable_1', '=', $resultado)->delete();
                }
                productos_configurables::destroy($resultado);
            }


        }else{
            $productos = productos_configurables::where('producto_id', $id)->where('variable_1','>', 0)->delete();
            $productos = productos_configurables::where('producto_id', $id)->first();
            if(empty($productos)){
                $producto = new productos_configurables();
                $producto->producto = $request->producto;
                $producto->producto_id = $id;
                $producto->save();
                productos::find($id)->update(['atributo_1'=> 0]);

            }


        }
        if (is_array($request->variables_2)) {
            $productos = productos_configurables::where('producto_id', '=', $id)->lists('variable_2')->toarray();
            if (count($request->variables_2) < count($productos)) {
                $resultados = array_diff($productos, $request->variables_2);
                foreach ($resultados as $resultado) {
                    $producto = productos_configurables::where('producto_id', '=', $id)
                        ->where('variable_2', '=', $resultado)->delete();
                }
                productos_configurables::destroy($resultado);

            }


        }
    }


}
