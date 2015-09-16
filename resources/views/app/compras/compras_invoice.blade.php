<div class="block">
    <div class="block-header hidden-print">
        <div class="block-options">
            <button class="btn btn-info" onclick="App.initHelper('print-page');">
                <i class="si si-printer"></i> Imprimir
            </button>
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-email">
                <i class="si si-envelope"></i> Enviar
            </button>
            <a class="btn btn-danger" href="{{ url('compras/pdf',$compras->id) }}">
                <i class="si si-cloud-download"></i> PDF
            </a>
        </div>
    </div>
    <div class="block-content block-content-narrow">
        <div class="h1 text-center push-10-t">COMPRA #{{ $compras->factura }} </div>
        <div class="text-center push-30">paguese antes de {{$compras->fecha_vencimiento  }}</div>
        <hr class="hidden-print">
        <div class="row items-push">
            <div class="col-xs-6 col-sm-4 col-lg-3">
                <p class="h2 font-w400 push-5">Proveedor</p>
                <address>
                    {{ $compras->proveedor->proveedor }}<br>
                    NIT: {{ $compras->proveedor->nit }}<br>
                    <i class="si si-envelope"> </i> : {{ $compras->proveedor->email }}<br>
                    <i class="si si-call-end"> </i> : {{ $compras->proveedor->telefono }}
                </address>
            </div>
            <div class="col-xs-6 col-sm-4  col-lg-3 pull-right text-right">
                <p class="h2 font-w400 push-5">Tienda</p>
                <address>
                    {{ $compras->tienda->tienda }}<br>
                    {{ $compras->tienda->direccion }}<br>
                    Region, Zip/Postal Code<br>
                    <i class="si si-call-end"></i> : {{ $compras->tienda->telefono }}
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
                    <td class="text-right">$ {{ number_format($compras->sub_total)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">IVA</td>
                    <td class="text-right">$ {{ number_format($compras->iva)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">Descuento</td>
                    <td class="text-right">$ {{ number_format($compras->dto)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="font-w600 text-right">Retefuente</td>
                    <td class="text-right">$ {{ number_format($compras->retefuente)}}</td>
                </tr>
                <tr class="active">
                    <td colspan="6" class="font-w700 text-uppercase text-right">Total a Pagar</td>
                    <td class="font-w700 text-right">$ {{ number_format($compras->valor_total)}}</td>
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
<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-popout modal-sm">
        <div class="modal-content">
            {!! Form::open(['method'=>'get','action' => ['ComprasController@mail', $compras->id]]) !!}
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-success">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Enviar Factura</h3>
                </div>
                <div class="block-content">
                    {!!Form::label('email', 'E-Mail:') !!}
                    {!!Form::email('email_address', null, ['class' => 'form-control field','placeholder'=>'email destinatario']) !!}
                </div>
            </div>
            <div class="modal-footer push-20-t">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                {!! Form::submit('Enviar!',['class'=>'btn btn-sm btn-primary','data-dismiss'=>'modal'])!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

