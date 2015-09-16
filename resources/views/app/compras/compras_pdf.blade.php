<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura de compra</title>
    {!! HTML::style('css/bootstrap.min.css') !!}
    {!! HTML::style('css/app.css') !!}
</head>
<body>
<main id="main-container">
    <!-- Content -->
    <div class="content">
        <div class="block">
            <div class="block-content block-content-narrow">
                <div class="h1 text-center">COMPRA #{{ $compras->factura }} </div>
                <div class="text-center">paguese antes de {{$compras->fecha_vencimiento  }}</div>
                <div class="col-sm-12" style="margin-top: 20px" >
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <p class="h2 font-w400 push-5">Proveedor</p>
                                <address>
                                    {{ $compras->proveedor->proveedor }}<br>
                                    NIT: {{ $compras->proveedor->nit }}<br>
                                    Correo : {{ $compras->proveedor->email }}<br>
                                    Telefono : {{ $compras->proveedor->telefono }}
                                </address>
                            </td>
                            <td class="text-right">
                                <p class="h2 font-w400 push-5">Tienda</p>
                                <address>
                                    {{ $compras->tienda->tienda }}<br>
                                    {{ $compras->tienda->direccion }}<br>
                                    Region, Zip/Postal Code<br>
                                    Telefono : {{ $compras->tienda->telefono }}
                                </address>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Valor</th>
                        <th class="text-right">IVA</th>
                        <th class="text-right">DTO</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center">{{ $item->producto_configurable_id }}</td>
                            <td class="">{{ $item->producto_configurable->producto }}</td>
                            <td class="text-center"><span class="badge badge-primary">{{ $item->cantidad }}</span>
                            </td>
                            <td class="text-right">$ {{ number_format($item->valor)}}</td>
                            <td class="text-right">{{ $item->iva/100 }}%</td>
                            <td class="text-right">{{ $item->dto/100 }}%</td>
                            <td class="text-right">$ {{ number_format($item->sub_total)}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="8" class="font-w600 text-right">Subtotal</td>
                        <td class="text-right">$ {{ number_format($compras->sub_total)}}</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="font-w600 text-right">IVA</td>
                        <td class="text-right">$ {{ number_format($compras->iva)}}</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="font-w600 text-right">Descuento</td>
                        <td class="text-right">$ {{ number_format($compras->dto)}}</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="font-w600 text-right">Retefuente</td>
                        <td class="text-right">$ {{ number_format($compras->retefuente)}}</td>
                    </tr>
                    <tr class="active">
                        <td colspan="8" class="font-w700 text-uppercase text-right">Total a Pagar</td>
                        <td class="font-w700 text-right">$ {{ number_format($compras->valor_total)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="text-muted text-center">
                <small>Muchas gracias por hacer negocio con nosotros. Esperamos con ancias seguir trabajando con
                    usted otra vez !
                </small>
            </p>
        </div>
    </div>
    </div>
</main>
</body>
</html>

