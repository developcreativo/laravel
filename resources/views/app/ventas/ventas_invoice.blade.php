<div class="block">
    <div class="block-header hidden-print">
        <div class="block-options">
            <button class="btn btn-info" onclick="App.initHelper('print-page');">
                <i class="si si-printer"></i> Imprimir
            </button>
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-email">
                <i class="si si-envelope"></i> Enviar
            </button>
            <a class="btn btn-danger" href="{{ url('ventas/pdf',$venta->id) }}">
                <i class="si si-cloud-download"></i> PDF
            </a>
        </div>
    </div>
    <div class="block-content block-content-narrow">
        <table width="100%" class="push-20">
            <tbody>
            <tr>
                <td width="25%">
                    <img src="{{ url($venta->tiendas->company->logo)  }}" width="100%">
                </td>
                <td width="55%">
                    <p class="h1 text-center push-5">{{ $venta->tiendas->tienda }}</p>

                    <p class="text-center remove-margin">NIT: {{ $venta->tiendas->nit }}</p>
                    <p class="text-center remove-margin"> Dirección: {{ $venta->tiendas->direccion }}</p>
                    <p class="text-center remove-margin"> REGIMEN {{ $venta->tiendas->regimen }}</p>
                    <p class="text-center remove-margin comercio">
                        <small>Resolución DIAN # {{ $venta->tiendas->resolucion_dian }} del {{ $venta->tiendas->fecha_dian }} rango {{ $venta->tiendas->rango }}</small>
                    </p>


                </td>
                <td width="20%" style="border: solid 1px #ccc; border-radius: 5px">
                    <div class="h2 text-center push-10-t">Factura</div>
                    <div class="h2 text-center">No. {{ $venta->tiendas->prefijo }} {{ $venta->factura }} </div>

                </td>
            </tr>
            </tbody>
        </table>


        <div class="block block-rounded block-bordered block-themed">
            <div class="block-header bg-primary hidden-print">
                <h3 class="block-title">Cliente:</h3>
            </div>
            <div class="block-content">
                <table width="100%" class="push-15">
                    <tr>
                        <td width="35%"><span
                                    class="font-w600"><strong>Nombre:</strong> </span> {{ $venta->clientes->cliente }}
                        </td>
                        <td width="40%"><span class="font-w600"><strong>Fecha de
                                    expedición: </strong></span>{{ $venta->created_at }}</td>
                        <td colspan="3" class="hidden-print">
                            @if($venta->pagado > 0)
                                <div style="position: absolute" >
                                    <p class="text-success h2 font-w600" style="border: 3px #46c37b  solid; border-radius: 10px; padding: 5px">PAGADO</p>
                                </div>
                            @else
                                <div style="position: absolute">
                                    <p class="text-danger h2 font-w600" style="border: 3px #d26a5c solid; border-radius: 10px; padding: 5px">PENDIENTE</p>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-w600"><strong>NIT/Cedula: </strong></span> {{ $venta->clientes->documento }}
                        </td>
                        <td><span class="font-w600"><strong>Fecha de
                                    vencimiento: </strong> </span>{{ $venta->vencimiento }}</td>
                    </tr>
                    <tr>
                        <td><span class="font-w600"><strong>Email: </strong></span> : {{ $venta->clientes->email }}</td>
                        <td><span class="font-w600"><strong>Vendedor: </strong></span>{{ $venta->user->name }}</td>
                    </tr>
                    <tr>
                        <td><span class="font-w600"><strong>Telefono: </strong></span>{{ $venta->clientes->telefono }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover" style="min-height: 400px;">
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
                <tfoot>
                <tr>
                    <td colspan="7"><p class="remove-margin bancos">Favor consignar en {{ $cuenta->banco }} cuenta {{ $cuenta->tipo }} {{ $cuenta->cuenta }} a nombre de {{ $cuenta->titular }} documento {{ $cuenta->documento }} y enviar copia de consiganción a {{ $cuenta->correo }}</p></td>
                </tr>
                </tfoot>
                <tbody>
                @foreach($venta->venta_detalle as $item)
                    <tr>
                        <td class="text-center">{{ $item->producto_configurable_id }}</td>
                        <td class="font-w600">{{ $item->productos_configurables->producto }}</td>
                        <td class="text-center"><span class="badge badge-primary">{{ $item->cantidad }}</span></td>
                        <td class="text-right">$ {{ number_format($item->venta)}}</td>
                        <td class="text-right">{{ $item->iva }}%</td>
                        <td class="text-right">{{ $item->dto }}%</td>
                        <td class="text-right">$ {{ number_format($item->subtotal)}}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>


        </div>
        <div class="row">
            <div style="width: 60%; display: inline-block" class="pull-left">
                <div class="block block-bordered">
                    <div class="block-content">
                        <p class="text-justify comercio">Esta factura de venta es un titulo valor según el articulo 772 código de comercio modificado por la ley 1231 de 2008.
                        En caso de mora en el pago se cobrará la máxima tasa autorizada por la ley. Art 621-774 y 779 C. de C.
                        La firma puesta por terceros en representacion del comprador implica su obligación de acuerdo al Art. 640 del C. de C.</p>
                    </div>
                </div>
            </div>
            <div style="width: 35%; display: inline-block" class="pull-right">
                <table class="table table-bordered table-condensed pull-right">
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Subtotal</td>
                        <td class="text-right">$ {{ number_format($venta->subtotal)}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">IVA</td>
                        <td class="text-right">$ +{{ number_format($venta->iva)}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Descuento</td>
                        <td class="text-right">$ -{{ number_format($venta->descuento)}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Retefuente</td>
                        <td class="text-right">$ -{{ number_format($venta->retefuente)}}</td>
                    </tr>
                    <tr class="active">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Total a Pagar</td>
                        <td class="font-w700 text-right">$ {{ number_format($venta->venta)}}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 60%; display: inline-block" class="pull-left">
                </br>
                </br>
                <table width="100%">
                    <tr>
                        <td width="40%" style="border-top: #ccc solid 1px ">Firma del cliente</td>
                        <td width="60%"></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="hidden-print">
    </div>

</div>
@include('app.ventas.ventas_modal_email')


