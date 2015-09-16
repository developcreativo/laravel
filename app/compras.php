<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class compras extends Model
{
    //
    public function getTable()
    {
        //return Session::get('tenant.id').'_compras';
        return 'compras';
    }

    protected $fillable = [
        'factura',
        'proveedor_id',
        'fecha_vencimiento',
        'valor_total',
        'sub_total',
        'iva',
        'dto',
        'retefuente',
        'pagado',
        'remision',
        'tienda_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo('App\proveedores');
    }

    public function tienda()
    {
        return $this->belongsTo('App\tiendas');
    }

    public static function crear($request)
    {
        $compra = new compras();
        $compra->factura = $request->factura;
        $compra->proveedor_id = $request->proveedor;
        $compra->fecha_vencimiento = $request->fecha;
        $compra->valor_total = $request->total;
        $compra->sub_total = $request->subT;
        $compra->iva = $request->IVA;
        $compra->dto = $request->DTO;
        $compra->remision = $request->remision | 0;
        $compra->retefuente = $request->rete;
        $compra->tienda_id = $request->tienda;
        $compra->save(); //guardo la compra
        $idlast = $compra->id;  //obtengo el ultimo id de compra para la compra detalle*/
        return $idlast;
    }

    public static function datos($compras)
    {
        $pagado = 0;
        $vencida = 0;
        $pendiente = 0;
        foreach ($compras as $compra) {
            if ($compra->valor_total - $compra->pagado > 0) {
                $pagado += $compra->pagado;
            }
            if (strtotime($compra->fecha_vencimiento) < time()) {
                $vencida += ($compra->valor_total - $compra->pagado);
            } else {
                $pendiente += ($compra->valor_total - $compra->pagado);
            }
        }
        return ['pagado' => $pagado, 'vencido' => $vencida, 'pendiente' => $pendiente];
    }

    public static function crear_pdf($id)
    {
        $compras = compras::with('proveedor')->findOrfail($id);
        $items = Compra_Detalle::where('compra_id', '=', $id)->with('producto_configurable')->get();
        $view = view('app/compras/compras_pdf', compact('compras', 'items'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf;
    }
}
