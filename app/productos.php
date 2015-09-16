<?php namespace App;

/**
 * Created by PhpStorm.
 * User: userpc
 * Date: 25/07/2015
 * Time: 6:27 PM
 *
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class productos extends Model
{
    public function getTable()
    {
        //return Session::get('tenant.id').'_productos';
        return 'productos';
    }

    protected $fillable = [
        'SKU',
        'producto',
        'categoria_id',
        'marca_id',
        'imagen',
        'descripcion',
        'venta',
        'compra',
        'rentabilidad',
        'impuestos',
        'atributo_1',
        'atributo_2'
    ];

    public function marcas()
    {
        return $this->belongsTo('App\marcas', 'marca_id');
    }

    public function categorias()
    {
        return $this->belongsTo('App\categorias', 'categoria_id');
    }
    public function impuesto()
    {
        return $this->belongsTo('App\impuestos', 'impuestos');
    }


    public function productos_configurables()
    {
        return $this->hasMany('App\productos_configurables', 'producto_id');
    }

    public static function crear($request)
    {
        $producto = productos::create($request->all());

        if ($request->hasFile('imagen')) {
            $producto->imagen = productos::imagen($producto->id,$request->file('imagen'));
            $producto->update();
        }else{
            $producto->imagen = 'img/img-default.png';
            $producto->update();
        }

        return $producto;


    }
    public static function imagen($id,$file)
    {

        $imageName = 'img/catalog/'.Auth::user()->company_id . '/' . $id . '-' . $file->getClientOriginalName();
        $file->move(base_path() . '/public/img/catalog/' . Auth::user()->company_id . '/', $imageName);
        return $imageName;
    }

    public static function actualizar($request, $id)
    {
        $producto = productos::findorfail($id);
        $producto->update($request->all());
        if ($request->hasFile('imagen')) {
            $producto->imagen = productos::imagen($producto->id,$request->file('imagen'));
            $producto->update();
        }

        return $producto;
    }
    public static function descargar($item){

        switch ($item) {
            case 'productos':
                $data = productos::select('SKU', 'producto', 'descripcion', 'categoria_id', 'marca_id',
                    'venta', 'compra', 'impuestos')->get();
                if(!count($data)>0){
                    $data = array_add($data,'SKU','SKU');
                    $data = array_add($data,'producto','producto');
                    $data = array_add($data,'descripcion','descripcion');
                    $data = array_add($data,'categoria_id','categoria_id');
                    $data = array_add($data,'marca_id','marca_id');
                    $data = array_add($data,'venta','venta');
                    $data = array_add($data,'compra','compra');
                    $data = array_add($data,'impuestos','impuestos');
                }
                break;
            case 'marcas':
                $data = marcas::select('marca')->get();
                if(!count($data)>0){
                    $data = array_add($data,'marca','marca');
                }
                break;
            case 'categorias':
                $data = categorias::select('categoria')->get();
                if(!count($data)>0){
                    $data = array_add($data,'categoria','categoria');
                }
                break;
            case 'impuestos':
                $data = impuestos::select('impuesto','valor')->get();
                if(!count($data)>0){
                    $data = array_add($data,'impuesto','impuesto');
                    $data = array_add($data,'valor','valor');
                }
                break;
        }


        $file = Excel::create($item, function ($excel) use ($data,$item) {
            $excel->sheet($item, function ($sheet) use ($data) {
                // Sheet manipulation
                $sheet->fromArray($data);
                $sheet->row(1, function ($row) {
                    // Set font weight to bold
                    $row->setFontWeight('bold');
                });
            });


        })->download('xlsx');
        return $file;
    }
    public static function importar($request){
        $nombre = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        switch ($nombre) {
            case 'productos':

                break;
            case 'marcas':

                break;
            case 'categorias':

                break;
            case 'impuestos':

                break;
        }
        $results = Excel::load($request->file('file'), function ($reader) {
        })->get();
        foreach ($results as $result) {
            $hola[] = $result->sku;
        }
    }
}