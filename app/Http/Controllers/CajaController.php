<?php

namespace App\Http\Controllers;

use App\caja;
use App\caja_detalle;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $caja_abierta = caja::CajaAbierta();
        if(isset($caja_abierta)){
            $saldo = caja::Totales($caja_abierta->id);
        }
        //dd($caja_abierta);

        $cajas = caja::with('tiendas','usuarios')->get();
        return view('app.cajas.caja_index',compact('cajas','caja_abierta','saldo'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->cierre == 'no'){
            caja::AbrirCaja($request->apertura,$request->nota);
            Session::flash('mensaje', Session::get('caja'));
            return redirect('caja');
        }else{
            //dd($request->all());
            $caja_id = caja::CerrarCaja($request->apertura,$request->nota);
            Session::flash('mensaje', Session::get('caja'));
            return redirect('caja/'.$caja_id);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $caja = caja::with('usuarios','tiendas')->find($id);
        $saldo = caja::Totales($id);
        $movimientos = caja_detalle::with('pagos')->where('caja_id',$id)->orderBy('created_at')->get();
        return view('app.cajas.caja_show',compact('caja','movimientos','saldo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
