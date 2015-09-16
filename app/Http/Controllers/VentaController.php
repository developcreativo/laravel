<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\categorias;
use App\clientes;
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
        $ventas = ventas::with('clientes','tiendas')->get();
        return view('app.ventas.ventas_index',compact('ventas'));
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
        $lastid = ventas::separador_remision($request);
        Bodegas::Agregar_Venta($request->items);
        ingresos::AgregarIngreso($lastid,$request->pagos);
        return redirect('ventas/pos/' . $lastid['venta']);
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
        //$tipo = facturacion::find($id);
        $venta = ventas::with('venta_detalle.productos_configurables','clientes','tiendas.company','user')
            ->find($id);
        return view('app/ventas/ventas_print', compact('venta'));

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

    public function pos(){
        $productos = Bodegas::with('productos_configurables.productos')->get()->toJson();
        $clientes = clientes::all();
        $categorias = categorias::orderBy('level')->get();
        $tiendas = tiendas::lists('tienda', 'id');
        return Response::view('app.ventas.ventas_pos',compact('tiendas','categorias','productos','clientes'));
    }

    public function pos_show($id)
    {
        //
        //$tipo = facturacion::find($id);
        $venta = ventas::with('venta_detalle.productos_configurables','clientes','tiendas.company','user')
            ->find($id);
        return view('app/ventas/ventas_pos_invoice', compact('venta'));

    }

    public function pdf($id)
    {
        $pdf = ventas::crear_pdf($id);
        return $pdf->download('venta_pos' . $id.'.pdf');
    }

    public function mail(Request $request, $id)
    {

        $pdf = ventas::crear_pdf($id);
        Mail::send('app.compras.compras_email', compact(['request']), function ($message) use ($pdf, $request) {
            $message->to($request->email_address)->subject('Envio de factura de compra ');
            $message->attachData($pdf->output(), "invoice.pdf");
        });
        Session::flash('mensaje','factura enviada con exito');
        return back();
    }
}
