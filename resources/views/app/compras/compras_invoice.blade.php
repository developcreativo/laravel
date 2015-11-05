<div class="block">
    <div class="block-header hidden-print">
        <div class="block-options">
            <button class="btn btn-info" onclick="App.initHelper('print-page');">
                <i class="si si-printer"></i> Imprimir
            </button>
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-email">
                <i class="si si-envelope"></i> Enviar
            </button>
            <a class="btn btn-danger" href="{{ url('compras/pdf',$compra->id) }}">
                <i class="si si-cloud-download"></i> PDF
            </a>
        </div>
    </div>
    <div class="block-content block-content-narrow">
        <div class="h1 text-center push-10-t">COMPRA #{{ $compra->factura }} </div>
        <div class="text-center push-30">paguese antes de {{$compra->fecha_vencimiento  }}</div>
        <hr class="hidden-print">
        <div class="row items-push">
            <div class="col-xs-6 col-sm-4 col-lg-3">
                <p class="h2 font-w400 push-5">Proveedor</p>
                <address>
                    {{ $compra->proveedor->proveedor }}<br>
                    NIT: {{ $compra->proveedor->nit }}<br>
                    <i class="si si-envelope"> </i> : {{ $compra->proveedor->email }}<br>
                    <i class="si si-call-end"> </i> : {{ $compra->proveedor->telefono }}
                </address>
            </div>
            <div class="col-xs-6 col-sm-4  col-lg-3 pull-right text-right">
                <p class="h2 font-w400 push-5">Tienda</p>
                <address>
                    {{ $compra->tienda->tienda }}<br>
                    {{ $compra->tienda->direccion }}<br>
                    Region, Zip/Postal Code<br>
                    <i class="si si-call-end"></i> : {{ $compra->tienda->telefono }}
                </address>
            </div>
        </div>
        <div class="table-responsive push-50">
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th>Producto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">valor</th>
                    <th class="text-right">IVA</th>
                    <th class="text-right">DTO</th>
                    <th class="text-right">Sub-total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="text-center">{{ $item->producto_configurable_id }}</td>
                        <td class="font-w600">{{ $item->producto_configurable->producto }}</td>
                        <td class="text-center"><span class="badge badge-primary">{{ $item->cantidad }}</span></td>
                        <td class="text-right">$ {{ number_format($item->valor)}}</td>
                        <td class="text-right">{{ $item->iva/100 }}%</td>
                        <td class="text-right">{{ $item->dto/100 }}%</td>
                        <td class="text-right">$ {{ number_format($item->sub_total)}}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="6" class="font-w600 text-right">Subtotal</td>
                    <td class="text-right">$ {{ number_format($compra->sub_total)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">IVA</td>
                    <td class="text-right">$ {{ number_format($compra->iva)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">Descuento</td>
                    <td class="text-right">$ {{ number_format($compra->dto)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">Retefuente</td>
                    <td class="text-right">$ {{ number_format($compra->retefuente)}}</td>
                </tr>
                <tr class="active">
                    <td colspan="6" class="font-w700 text-uppercase text-right">Total a Pagar</td>
                    <td class="font-w700 text-right">$ {{ number_format($compra->valor_total)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr class="hidden-print">
        <p class="text-muted text-center">
            <small>Muchas gracias por hacer negocio con nosotros. Esperamos con ancias seguir trabajando con usted otra
                vez !
            </small>
        </p>
    </div>

</div>
@include('app.compras.compras_modal_email')

