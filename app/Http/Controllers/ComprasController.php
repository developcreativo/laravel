<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\Compra_Detalle;
use App\compras;
use App\Historico_Compras;
use App\productos;
use App\productos_configurables;
use App\proveedores;
use App\tiendas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ComprasController extends Controller
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
        $compras = compras::with('tienda', 'proveedor')->get();
        $datos = compras::datos($compras);

        return view('app/compras/compras_index', compact(['compras', 'datos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $proveedores = proveedores::lists('proveedor', 'id');
        $tiendas = tiendas::lists('tienda', 'id');
        $compras = productos_configurables::with('productos.marcas')->get()->toJson();
        return view('app/compras/compras_create', compact(['proveedores', 'tiendas', 'compras']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\ComprasRequest $request)
    {
        $idlast = compras::crear($request); //crear compra y obtener id de la misma
        $items = Input::get('items'); //obtengo los datos de los productos
        Compra_Detalle::AgregarCompraDetalle($items, $idlast); //agregar los productos a la compra detalle
        Session::put('bodega', Input::get('tienda')); //le doy session al id de la bodega
        Bodegas::AgregarCompra($items, Input::get('remision', 0)); //agregos los productos a la bodega seleccionada
        Session::flash('mensaje', 'compra creada con exito');
        return redirect('compras');
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
        $compras = compras::with('proveedor')->findOrfail($id);
        $items = compra_detalle::where('compra_id', '=', $id)->with('producto_configurable')->get();
        return view('app/compras/compras_show', compact(['compras', 'items']));
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

    public function pagar($id)
    {
        $compra = compras::find($id);
        return $compra;
    }

    public function pdf($id)
    {
        $pdf = compras::crear_pdf($id);
        return $pdf->download('factura_compra' . $id . '.pdf');
    }

    public function mail(Request $request, $id)
    {
        $to = $request->email_address;
        Mail::queue('app.compras.compras_email', compact(['request']), function ($message) use ($id, $to) {
            $pdf = compras::crear_pdf($id);
            $message->to($to)->subject('Envio de factura de compra ');
            $message->attachData($pdf->output(), "invoice.pdf");
        });
        Session::flash('mensaje', 'factura enviada con exito');
        return back();
    }
}
