<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\categorias;
use App\ciudades;
use App\clientes;
use App\departamentos;
use App\facturacion;
use App\ingresos;
use App\productos;
use App\tiendas;
use App\ventas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class VentaController extends Controller
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
        $ventas = ventas::with('clientes', 'tiendas', 'factura_venta')->where('remision', 0)->get();
        return view('app.ventas.ventas_index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $tiendas = tiendas::lists('tienda','id');
        $clientes = clientes::all();
        $productos = Bodegas::with('productos_configurables.productos.marcas')->get()->toJson();
        $ciudades = ciudades::all()->toJson();
        $departamentos = departamentos::lists('departamento','id');
        return view('app.ventas.ventas_create', compact('tiendas','clientes','productos','ciudades','departamentos'));
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
        $lastid = ventas::separador_remision($request);
        tiendas::numero_factura($lastid);
        Bodegas::Agregar_Venta($request->items);
        ingresos::AgregarIngreso($lastid, $request->pagos);
        //crear modulo de despacho
        $factura = facturacion::AgregarFacturacion($lastid);

        return redirect('ventas/' . $lastid['venta']['id']);
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
        $venta = ventas::with('venta_detalle.productos_configurables', 'clientes',
            'tiendas.company', 'user', 'ingreso_venta.formas_pago')->find($id);
        //dd($venta);
        return view('app/ventas/ventas_show', compact('venta'));

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


    public function pdf($id)
    {
        $pdf = ventas::crear_pdf($id);
        return $pdf->download('venta_pos' . $id . '.pdf');
    }

    public function mail(Request $request, $id)
    {

        $pdf = ventas::crear_pdf($id);
        Mail::send('app.compras.compras_email', compact(['request']), function ($message) use ($pdf, $request) {
            $message->to($request->email_address)->subject('Envio de factura de compra ');
            $message->attachData($pdf->output(), "invoice.pdf");
        });
        Session::flash('mensaje', 'factura enviada con exito');
        return back();
    }
}
