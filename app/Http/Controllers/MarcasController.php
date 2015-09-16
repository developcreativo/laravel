<?php

namespace App\Http\Controllers;

use App\marcas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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

        $buscaren = $request->header('referer');
        $cadena = strpos($buscaren,'atributo');
        $marcas = marcas::create($request->all());
        if($cadena === false){
            $refresh = 'no';
        }else{
            $refresh = 'si';
            Session::flash('mensaje','has creado una nueva marca');
        }
        $lista_marcas = '<option value="' .$marcas->id . '">' . $marcas->marca . '</option>';
        Cache::forget('marcas'. Session::get('tenant.id'));
        return response()->json(['marca'=>$lista_marcas,'mensaje'=>'has creado una nueva marca','refresh'=>$refresh]);
        //
        //
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
