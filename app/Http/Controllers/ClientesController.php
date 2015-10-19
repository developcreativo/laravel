<?php

namespace App\Http\Controllers;

use App\ciudades;
use App\clientes;
use App\departamentos;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $cliente = clientes::find($id);
        return view('app.clientes.clientes_show', compact('cliente'));
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
        clientes::destroy($id);
        return response(['id'=>$id,'mensaje'=>'Cliente eliminado con exito']);
    }
}
