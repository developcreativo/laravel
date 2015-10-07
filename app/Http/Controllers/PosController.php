<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\categorias;
use App\clientes;
use App\facturacion;
use App\ingresos;
use App\tiendas;
use App\ventas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $productos = Bodegas::with('productos_configurables.productos')->get()->toJson();
        $clientes = clientes::all();
        $categorias = categorias::orderBy('level')->get();
        $tiendas = tiendas::lists('tienda', 'id');
        return Response::view('app.ventas.ventas_pos', compact('tiendas', 'categorias', 'productos', 'clientes'));

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
        dd($request->all());
        $lastid = ventas::separador_remision($request);
        tiendas::numero_factura($lastid);
        Bodegas::Agregar_Venta($request->items);
        ingresos::AgregarIngreso($lastid, $request->pagos);
        $factura = facturacion::AgregarFacturacion($lastid);

        return redirect('ventas/pos/' . $factura);
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
        $tipo = facturacion::find($id);
        if (!$tipo->venta_id == "") {
            $venta = ventas::with('venta_detalle.productos_configurables', 'clientes', 'tiendas.company', 'user')
                ->find($tipo->venta_id);
        }
        if (!$tipo->venta_id == "") {
            $remision = ventas::with('venta_detalle.productos_configurables', 'clientes', 'tiendas.company', 'user')
                ->find($tipo->remision_id);
        }
        return view('app/ventas/ventas_pos_invoice', compact('venta', 'remision'));
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
}
