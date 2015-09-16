<?php

namespace App\Http\Controllers;

use App\atributos;
use App\atributos_sub;
use App\categorias;
use App\impuestos;
use App\marcas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AtributoController extends Controller
{
    /**
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
        //
        $marcas = marcas::with('productos')->get();
        $categorias = categorias::all();
        $impuestos = impuestos::all();
        $categorias_padre = categorias::lista_padres(1);
        $atributos = atributos::with('atributos_sub')->get();
        return Response::view('app.atributos.atributos_index',compact(['marcas','categorias',
            'impuestos','atributos','categorias_padre']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $atributo = atributos::create($request->all());
        Session::flash('mensaje','atributo creado con exito');
        return Response::redirect('atributos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function variables(Request $request)
    {
        //
        $variables = atributos_sub::where('atributo_id','=',$request->id)->get();
        foreach ($variables as $variable) {
            $lista_variables[]  = '<option value="' .$variable->id . '">' . $variable->variable . '</option>';
        }
        return response()->json(['variables' => $lista_variables]);
    }
}
