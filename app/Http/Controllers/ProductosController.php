<?php

namespace App\Http\Controllers;

use App\atributos;
use App\atributos_sub;
use App\categorias;
use App\Historico_Compras;
use App\impuestos;
use App\marcas;
use App\productos;
use App\productos_configurables;
use App\Remember;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class ProductosController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //muestra todos los productos del overview
        $productos = Cache::remember('productos', 60, function () {
            return productos::with('marcas')->with('categorias')->get();
        });

        return Response::view('app/productos/productos_index', ['productos' => $productos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $i = Session::get('tenant.id');
        //creacion de un nuevo producto
        $marcas = Cache::remember('marcas' . $i, 60, function () {
            return marcas::lists('marca', 'id')->all();
        });
        $categorias = categorias::lista(1);
        $categorias_padre = categorias::lista_padres(1);
        $atributos = Cache::remember('atributos', 60, function () {
            return atributos::lists('atributo', 'id')->all();
        });
        $impuestos = Cache::remember('impuestos', 60, function () {
            return impuestos::lists('impuesto', 'id')->all();
        });
        $imagen = url('img/img-default.png');
        $block = '';
        //variables solo funcionan para editar es para reutilizar el mismo formulario
        $variable1 = '';
        $variable2 = '';
        $lista_variable1[] = '';
        $lista_variable2[] = '';
        return Response::view('app/productos/producto_create',
            compact(['marcas', 'categorias', 'atributos', 'impuestos', 'categorias_padre', 'block', 'imagen',
                'variable1', 'variable2', 'lista_variable1', 'lista_variable2']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\productosRequest $request)
    {
        //
        $producto = productos::crear($request, 'create');
        productos_configurables::crear($request, $producto->id);
        Session::flash('mensaje', 'Producto creado exitosamente');
        Cache::forget('productos');
        return redirect('productos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $producto = productos::find($id);
        $productos = productos_configurables::where('producto_id', '=', $producto->id)->get();
        $atributos = atributos::all();
        $atributos = $atributos->lists('atributo', 'id')->all();
        $variables = productos_configurables::variables($productos, $producto);
        $block = 'disabled';
        //$productos = productos_configurables::where('producto_id','=',$producto->id)->get();
        return Response::view('app.productos.producto_show', compact(['producto', 'block', 'variables', 'atributos',
            'productos']))->setTtl(60);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $producto = productos::findorfail($id);
        $marcas = marcas::lists('marca', 'id')->all();
        $categorias = categorias::lista(1);
        $categorias_padre = categorias::lista_padres(1);
        $atributos = atributos::lists('atributo', 'id')->all();
        $impuestos = impuestos::lists('impuesto', 'id')->all();
        $block = '';
        $imagen = $producto->imagen;
        $variables = productos_configurables::where('producto_id', '=', $producto->id)->get();

        if (!$variables->isEmpty()) {
            $lista_variable1 = atributos_sub::where('atributo_id', '=', $producto->atributo_1)->lists('variable', 'id')->toArray();
            $lista_variable2 = atributos_sub::where('atributo_id', '=', $producto->atributo_2)->lists('variable', 'id')->toArray();
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
        return view('app/productos/producto_edit',
            compact(['producto', 'marcas', 'categorias', 'atributos', 'impuestos',
                'categorias_padre', 'imagen', 'block', 'variable1', 'variable2',
                'lista_variable1', 'lista_variable2']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $producto = productos::actualizar($request, $id);
        productos_configurables::crear($request, $producto->id);
        productos_configurables::eliminar($request, $producto->id);
        Session::flash('mensaje', 'Producto editado exitosamente');
        Cache::forget('productos');
        return redirect('productos/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function carga_masiva()
    {
        //carga masiva de productos desde excel
        $marcas = marcas::orderby('marca')->get();
        $categorias = categorias::orderby('categoria')->get();
        $impuestos = impuestos::orderby('impuesto')->get();
        return Response::view('app.productos.producto_carga_masiva', compact(['marcas', 'categorias', 'impuestos']))->setTtl(60);

    }


    public function download($bajar)
    {

        //descargar documento seleccionado
        $file = productos::descargar($bajar);
        return Response::download($file);
    }

    public function import(Request $request)
    {
        // get the results
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ]);
        if ($validator->fails()) {
            return error(404);
        }
        return productos::importar($request);


    }

    public function chart(Request $request)
    {
        //cargar graficos de estadisticas
        $id = $request->id;
        $compras = Historico_Compras::where('codigo',$id)->get();
        foreach($compras as $compra){
            $label[] = date_format($compra->created_at, 'd/m/y');
            $data[] = $compra->precio;
        }
        $compras = (['label'=>$label,'data'=>$data]);
        return response()->json($compras);
    }
}
