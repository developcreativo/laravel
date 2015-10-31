<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\caja;
use App\categorias;
use App\ciudades;
use App\clientes;
use App\departamentos;
use App\facturacion;
use App\ingresos;
use App\tiendas;
use App\ventas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

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
        //verificar si la caja esta abierta
        $caja_abierta = caja::CajaAbierta();
        if(!isset($caja_abierta)){
            Session::flash('mensaje','Primero debe abrir al caja para vender');
            return redirect('caja');
        }
        $productos = Bodegas::with('productos_configurables.productos')->get()->toJson();
        $clientes = clientes::all();
        $categorias = categorias::orderBy('level')->get();
        $tiendas = tiendas::lists('tienda', 'id');
        $ciudades = ciudades::all()->toJson();
        $departamentos = departamentos::lists('departamento', 'id');
        return Response::view('app.ventas.ventas_pos', compact('tiendas', 'categorias',
            'productos', 'clientes','ciudades','departamentos'));

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
        //dd($request->all());
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
        
        if (!$tipo->venta_id == 0) {
            $venta = ventas::with('venta_detalle.productos_configurables', 'clientes', 'tiendas.company', 'user')
                ->find($tipo->venta_id);
        }
        if (!$tipo->remision_id == 0) {
            $remision = ventas::with('venta_detalle.productos_configurables', 'clientes', 'tiendas.company', 'user')
                ->find($tipo->remision_id);
        }
        //dd($remision);
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
