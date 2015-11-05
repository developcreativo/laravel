<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'inicioController@index');
Route::get('home', 'inicioController@index');

/******* configuracion ********/
Route::resource('configuracion', 'ConfiguracionController',['except' => []]);
Route::resource('users', 'UserController',['except' => []]);

/******* productos configurables ********/
Route::resource('productos/variables', 'ProductosVariablesController',['except' => []]);

/******* productos ********/
Route::get('productos/chart', 'ProductosController@chart');
Route::get('productos/carga_masiva/download/{bajar}', 'ProductosController@download');
Route::get('productos/carga_masiva', 'ProductosController@carga_masiva');
Route::post('productos/carga_masiva', 'ProductosController@import');
Route::resource('productos', 'ProductosController',['except' => ['carga_masiva','download','import','chart']]);

/******* compras ********/
Route::get('compras/chart', 'ComprasController@chart');
Route::get('compras/print/{id}', 'ComprasController@imprimir');
Route::get('compras/pdf/{id}', 'ComprasController@pdf');
Route::get('compras/mail/{id}', 'ComprasController@mail');
Route::put('compras/pagar/{id}', 'ComprasController@pagar');
Route::resource('compras', 'ComprasController',['except' => ['chart','print','pdf','mail','pagar']]);

/******* marcas ********/
Route::resource('marcas', 'MarcasController',['except' => []]);

/******* categorias ********/
Route::resource('categorias', 'CategoriasController',['except' => []]);

/******* atributos ********/
Route::post('productos/atributos', 'AtributoController@variables');
Route::resource('atributos', 'AtributoController',['except' => ['variables']]);

/******* proveedores ********/
Route::get('proveedores/chart', 'ProveedoresController@chart');
Route::resource('proveedores', 'ProveedoresController',['except' => ['chart']]);

/******* clientes ********/
Route::get('clientes/chart', 'ClientesController@chart');
Route::resource('clientes', 'ClientesController',['except' => ['chart']]);

/******* impuestos ********/
Route::resource('impuestos', 'ImpuestosController',['except' => []]);

/******* despachos ********/
Route::resource('despachos', 'DespachosController',['except' => []]);

/******* POS ********/
Route::resource('ventas/pos', 'PosController',['except' => []]);

/******* remision ********/
Route::resource('remision', 'RemisionController',['except' => []]);

/******* ventas ********/
Route::get('ventas/pdf/{id}', 'VentaController@pdf');
Route::get('ventas/print/{id}', 'VentaController@imprimir');
Route::put('ventas/pagar/{id}', 'VentaController@pagar');
Route::get('ventas/mail/{id}', 'VentaController@mail');
Route::resource('ventas', 'VentaController',['except' => ['mail','pdf','imprimir','pagar']]);

/******* Caja ********/
Route::resource('caja', 'CajaController',['except' => []]);

/******* Ingresos ********/
Route::resource('ingresos', 'IngresosController',['except' => []]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

