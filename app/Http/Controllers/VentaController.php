<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\caja;
use App\categorias;
use App\ciudades;
use App\clientes;
use App\cuentas_bancarias;
use App\departamentos;
use App\despachos;
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
        //verificar si la caja esta abierta
        $caja_abierta = caja::CajaAbierta();
        if (!isset($caja_abierta)) {
            Session::flash('mensaje', 'Primero debe abrir al caja para vender');
            return redirect('caja');
        }
        $tiendas = tiendas::lists('tienda', 'id');
        $clientes = clientes::all();
        $productos = Bodegas::with('productos_configurables.productos.marcas')->get()->toJson();
        $ciudades = ciudades::all()->toJson();
        $departamentos = departamentos::lists('departamento', 'id');
        return view('app.ventas.ventas_create', compact('tiendas', 'clientes', 'productos', 'ciudades', 'departamentos'));
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
        $lastid = ventas::separador_remision($request);
        tiendas::numero_factura($lastid);
        Bodegas::Agregar_Venta($request->items);
        ingresos::AgregarIngreso($lastid, $request->pagos);
        $factura = facturacion::AgregarFacturacion($lastid);
        despachos::crear_despacho($request, $factura);
        if (!$lastid['venta'] == "") {
            return redirect('ventas/' . $lastid['venta']['id']);
        } else {
            return redirect('ventas/' . $lastid['remision']['id']);
        }

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
        $factura = facturacion::with('despachos')->where('venta_id', $id)->orwhere('remision_id', $id)->first();
        //dd($despacho);
        //dd($cuenta);
        return view('app/ventas/ventas_show', compact('venta', 'factura'));

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

    public function imprimir($id)
    {
        $venta = ventas::with('venta_detalle.productos_configurables', 'clientes',
            'tiendas.company', 'user', 'ingreso_venta.formas_pago')->find($id);
        $cuenta = cuentas_bancarias::where('principal', 1)->first();
        //dd($cuenta);
        return view('app/ventas/ventas_print', compact('venta', 'cuenta'));
    }

    public function pagar(Request $request, $id)
    {

        $venta = ventas::find($id);
        $valor = 0;
        foreach ($request->pagos as $pago) {
            $valor += $pago['valor'];
        }
        $venta->pagado = $venta->pagado + $valor;
        $venta->save();
        if ($venta->remision == 1) {
            $lastid['venta'] = "";
            $lastid['remision'] = ['id' => $venta->id, 'factura' => $venta->factura];
        } else {
            $lastid['remision'] = "";
            $lastid['venta'] = ['id' => $venta->id, 'factura' => $venta->factura];
        }
        ingresos::AgregarIngreso($lastid, $request->pagos);
        return redirect('ventas/' . $id);

    }


    public function pdf($id)
    {
        $pdf = ventas::crear_pdf($id);
        return $pdf->download('venta_' . $id . '.pdf');
    }

    public function mail(Request $request, $id)
    {

        $pdf = ventas::crear_pdf($id);
        Mail::send('app.ventas.ventas_email', compact(['request']), function ($message) use ($pdf, $request) {
            $message->to($request->email_address)->subject('Envio de factura de venta ');
            $message->attachData($pdf->output(), "invoice.pdf");
        });
        Session::flash('mensaje', 'factura enviada con exito');
        return back();
    }
}
