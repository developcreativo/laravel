<?php

namespace App\Http\Controllers;

use App\compras;
use App\proveedores;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $proveedores = proveedores::all();
        return Response::view('app.proveedores.proveedores_index', compact(['proveedores']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return Response::view('app.proveedores.proveedores_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        proveedores::create($request->all());
        return redirect('proveedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
        $proveedor = proveedores::with('compras.tienda')->find($id);
        return Response::view('app.proveedores.proveedores_show', compact(['proveedor']));
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
        $proveedor = proveedores::find($id);
        $proveedor->update($request->all());
        Session::flash('mensaje', 'Proveedor actualizado correctamente');
        return redirect('proveedores/' . $id);

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
        Proveedores::destroy($id);
        return response()->json(['mensaje' => 'Proveedor eliminado satisfactoriamente', 'id' => $id]);
    }

    public function chart(Request $request)
    {
        //cargar graficos de estadisticas
        $id = $request->id;
        $compras = compras::where('proveedor_id', $id)->get();
        $datos = compras::datos($compras);
        $pagado = ['value' => $datos['pagado'], 'label' => 'pagado','color'=>'rgba(171, 227, 125, 1)','highlight'=>'rgba(171, 227, 125, .75)'];
        $vencido = ['value' => $datos['vencido'], 'label' => 'vencido','color'=>'rgba(250, 219, 125, 1)','highlight'=>'rgba(250, 219, 125, 75)'];
        $pendiente = ['value' => $datos['pendiente'], 'label' => 'pendiente','color'=>'rgba(117, 176, 235, 1)','highlight'=>'rgba(117, 176, 235, 75)'];
        $data = [$pagado, $vencido,$pendiente];
        return response()->json(['data' => $data]);
    }
}
