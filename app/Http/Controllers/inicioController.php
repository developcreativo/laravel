<?php namespace App\Http\Controllers;


use App\productos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class inicioController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company_id;
        $bodega = Auth::user()->tienda_id;
        Session::put('bodega',$bodega);
        if ($company == 0) {
            return Redirect::to('configuracion');
        } else {
            Session::put('tenant.id', $company);
            $productos = productos::with('marcas')->get();
            return view('inicio')->with('productos', $productos);
        }
    }


}