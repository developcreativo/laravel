<?php

namespace App\Http\Controllers;

use App\caja;
use App\ingresos;
use App\ventas;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //primero verificamos que este abierta la caja
        $caja_abierta = caja::CajaAbierta();
        if (!isset($caja_abierta)) {
            Session::flash('mensaje', 'Primero debe abrir al caja para Agregar un pago a la venta');
            return redirect('caja');
        }

        $ventas = ventas::with('clientes')->whereraw('venta > pagado')->get();
        return view('app.ingresos.ingresos_create', compact('ventas'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if (isset($request->items)) {
            ingresos::requestXfactura($request);
        } else {
            ingresos::ingresoSimple($request);
        }


        Session::flash('mensaje', 'Ingreso creado con éxito');

        return redirect('ingresos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
