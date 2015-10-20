<?php

namespace App\Http\Controllers;

use App\ciudades;
use App\clientes;
use App\departamentos;
use App\venta_detalle;
use App\ventas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $clientes = clientes::all();
        $ciudades = ciudades::all()->toJson();
        $departamentos = departamentos::lists('departamento', 'id');
        return view('app.clientes.clientes_index', compact('clientes','ciudades','departamentos'));
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
        $cliente = clientes::create($request->all());
        return response()->json(['cliente'=>$cliente,'mensaje'=>'Cliente creado con exito']);

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
        dd(ventas::top_ventas($id));
        $cliente = clientes::find($id);
        $ciudadesJSON = ciudades::all()->toJson();
        $departamentos = departamentos::lists('departamento', 'id');
        $ciudades = ciudades::lists('ciudad', 'id');
        $ventas = ventas::with('clientes', 'tiendas', 'factura_venta')->where('cliente_id', $id)->get();

        $datos = ventas::datos($ventas);
        return view('app.clientes.clientes_show', compact('cliente','ciudades','ciudadesJSON',
            'departamentos','ventas','datos'));
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
        //dd($request->all());
        clientes::find($id)->update($request->all());
        Session::flash('mensaje','cliente actualizado exitosamente');
        return redirect('clientes/'.$id);
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
        clientes::destroy($id);
        return response(['id'=>$id,'mensaje'=>'Cliente eliminado con exito']);
    }

    public function chart(Request $request)
    {
        //cargar graficos de estadisticas
        $id = $request->id;
        $top_ventas = ventas::top_ventas($id);
        foreach ($top_ventas as $compra) {
            $label[] = date_format($compra->created_at, 'd/m/y');
            $data[] = $compra->precio;
        }
        $compras = (['label' => $label, 'data' => $data]);
        return response()->json($compras);
    }
}
