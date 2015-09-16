<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_categorias';
        return 'categorias';
    }
    protected $fillable = ['categoria'];

    public function productos()
    {
        return $this->hasMany('App\productos','categoria_id');
    }
    public static function crear($request){
        //funcion para crear categorias y subcategorias
        $categorias = new categorias();
        $categorias->categoria = $request->categoria;
        if($request->sub_categoria == 1){
            $level= categorias::orderBy('level','desc')->where('level','>=', $request->level)
                ->where('level','<', ($request->level+1))->first();
            $categorias->level = $level->level+0.01;
            $categorias->save();
        }else{
            $categorias->save();
            $categorias->level = $categorias->id;
            $categorias->update();
        }

    }

    public static function lista($option){

        if($option == 1){
            $categorias = categorias::orderBy('level')->select('categoria', 'id','level')->get();
            $lista_categorias = array();
            foreach($categorias as $categoria){
                $n = $categoria->level;
                $whole = floor($n);
                $fraction = $n - $whole;
                if( $fraction > 0 ){
                    $lista_categorias = array_add( $lista_categorias ,$categoria->id , ' -- ' . $categoria->categoria);
                }else{
                    $lista_categorias = array_add($lista_categorias , $categoria->id , $categoria->categoria);
                }
            }
        }else{
            $categorias = categorias::orderBy('level')->select('categoria', 'id','level')->get();
            foreach($categorias as $categoria){
                $n = $categoria->level;
                $whole = floor($n);
                $fraction = $n - $whole;
                if( $fraction > 0 ){
                    $lista_categorias[] = '<option value="' .$categoria->id . '"> -- ' . $categoria->categoria . '</option>';
                }else{
                    $lista_categorias[] = '<option value="' .$categoria->id . '">' . $categoria->categoria . '</option>';
                }
            }
        }


        return $lista_categorias;
    }
    public static function lista_padres($option){
        if($option == 1) {
            $categorias = categorias::orderBy('level')->select('categoria', 'id', 'level')->get();
            $lista_categorias = array();
            foreach ($categorias as $categoria) {
                $n = $categoria->level;
                $whole = floor($n);
                $fraction = $n - $whole;

                if (!$fraction > 0) {
                    $lista_categorias = array_add($lista_categorias, $categoria->id, $categoria->categoria);
                }
            }
        }else{
            $categorias = categorias::orderBy('level')->select('categoria', 'id', 'level')->get();
            foreach ($categorias as $categoria) {
                $n = $categoria->level;
                $whole = floor($n);
                $fraction = $n - $whole;
                if (!$fraction > 0) {
                    $lista_categorias[] = '<option value="' .$categoria->id . '">' . $categoria->categoria . '</option>';
                }
            }
        }
        return $lista_categorias;
    }
    public static function json_categoria(){
        $categorias = categorias::orderBy('level')->get();
        foreach ($categorias as $categoria) {
            $n = $categoria->level;
            $whole = floor($n);
            $fraction = $n - $whole;
            if (!$fraction > 0) {
                $lista_categorias[] = '<option value="' .$categoria->id . '">' . $categoria->categoria . '</option>';
            }else{

            }
        }
    }

}
