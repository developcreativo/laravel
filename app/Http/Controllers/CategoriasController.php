<?php

namespace App\Http\Controllers;

use App\categorias;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $categorias = categorias::lista(1);
        dd($categorias);
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $buscaren = $request->header('referer');
        $cadena = strpos($buscaren, 'atributo');
        if ($cadena === false) {
            $refresh = 'no';
        } else {
            $refresh = 'si';
            Session::flash('mensaje', 'has creado una nueva categoria');
        }
        $categorias = categorias::crear($request);
        $categorias = categorias::lista(2);
        $categorias_padre = categorias::lista_padres(2);
        return response()->json(['categoria' => $categorias,
            'categorias_padre' => $categorias_padre,
            'mensaje' => 'has creado una nueva categoria',
            'refresh' => $refresh]);
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
}
