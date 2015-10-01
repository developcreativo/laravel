<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura de compra</title>
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/app.css') !!}
    {!! HTML::style('css/contapp.css') !!}
</head>
<body>
<main id="main-container">
    <!-- Content -->
    <div class="block">
        <div class="block-content block-content-narrow">
            <table width="100%" class="push-20">
                <tbody>
                <tr>
                    <td width="30%">
                        <img src="{{ url($venta->tiendas->company->logo)  }}" width="250">
                    </td>
                    <td width="50%">
                        <p class="h1 text-center remove-margin">{{ $venta->tiendas->tienda }}</p>

                        <p class="text-center remove-margin">NIT: {{ $venta->tiendas->nit }}</p>

                        <p class="text-center remove-margin"> REGIMEN {{ $venta->tiendas->regimen }}</p>

                        <p class="text-center remove-margin"> Dirección: {{ $venta->tiendas->direccion }}</p>
                    </td>
                    <td width="20%" style="border: solid 1px #ccc; border-radius: 5px">
                        <div class="h2 text-center push-10-t">Factura</div>
                        <div class="h2 text-center">No. {{ $venta->factura }} </div>

                    </td>
                </tr>
                </tbody>
            </table>


            <div class="block block-rounded block-bordered block-themed">
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
                            <td><span class="font-w600"><strong>Telefono: </strong></span>
                                : {{ $venta->clientes->telefono }}</td>
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
                <table class="table table-bordered table-condensed table-hover" style="min-height: 350px;">
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
                            <p>Observaciones: </p></br>
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
                            <td width="20%"></td>
                            <td width="40%" style="border-top: #ccc solid 1px ">Vendedor</td>

                        </tr>
                    </table>
                </div>
            </div>
            <hr class="hidden-print">
        </div>

    </div>
</main>
</body>
</html>