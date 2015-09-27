@extends('layouts.master')

@section('title')
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
    <li><a href="{{url('ventas')}}">Ventas</a></li>
@stop

@section('content')
    <div class="col-sm-8">
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title"><i class="fa fa-newspaper-o"></i> Factura: {{ $venta->factura }}
                    <span class="pull-right">Fecha: {{ $venta->created_at }}</span></h3>

            </div>
            <div class="block-content form-horizontal">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <!---  Field --->
                            {!! Form::hidden('cliente_id', null, ['class' => 'cliente_id']) !!}
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('cliente', $venta->clientes->cliente, ['class' => 'form-control cliente','readonly']) !!}
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-info"></i></div>
                            {!! form::text('documento', $venta->clientes->documento , ['class' => 'form-control documento',
                            'placeholder'=>'Nit o Cedula','readonly'])!!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! form::text('fecha', $venta->vencimiento , ['class' => 'form-control',
                            'data-date-format'=>'yyyy-mm-dd','placeholder'=>'Vence','readonly'])!!}
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <!--- Correo Field --->
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            {!! form::email('email', $venta->clientes->email , ['class' => 'form-control email',
                            'placeholder'=>'Correo electrónico','readonly'])!!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            {!! form::text('telefono', $venta->clientes->telefono , ['class' => 'form-control telefono',
                            'placeholder'=>'(000)-(0000000)','readonly'])!!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title"><i class="si si-list"></i> Detalle: </h3>
            </div>
            <div class="block-content">
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
                    @foreach($venta->venta_detalle as $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="font-w600">{{ $item->productos_configurables->producto }}</td>
                            <td class="text-center"><span class="badge badge-primary">{{ $item->cantidad }}</span></td>
                            <td class="text-right">${{ number_format($item->venta)  }}</td>
                            <td class="text-right">{{ $item->iva }}%</td>
                            <td class="text-right">{{ $item->dto }}%</td>
                            <td class="text-right">${{ number_format($item->cantidad * $item->venta) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="6" class="font-w600 text-right">Subtotal</td>
                        <td class="text-right">${{number_format($venta->subtotal) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">IVA</td>
                        <td class="text-right">$+{{number_format($venta->iva) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Descuento</td>
                        <td class="text-right">$-{{number_format($venta->descuento) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Retefuente</td>
                        <td class="text-right">$+{{number_format($venta->retefuente) }}</td>
                    </tr>
                    <tr class="active">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Total a Pagar</td>
                        <td class="font-w700 text-right">${{number_format($venta->venta) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="col-xs-6 col-sm-2">
        <a class="block block-link-hover2 text-center" href="http://localhost/productos/carga_masiva/download/marcas">
            <div class="block-content block-content-full bg-amethyst">
                <i class="si si-printer fa-4x text-white"></i>

                <div class="font-w600 text-white-op push-15-t">Imprimir</div>
            </div>
        </a>
    </div>
    <div class="col-xs-6 col-sm-2">
        <a class="block block-link-hover2 text-center" href="http://localhost/productos/carga_masiva/download/categorias">
            <div class="block-content block-content-full bg-city">
                <i class="si si-envelope fa-4x text-white"></i>

                <div class="font-w600 text-white-op push-15-t">Enviar</div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <div class="block block-themed">
            <div class="block-header bg-success">
                <h3 class="block-title">Formas de Pago: </h3>
            </div>
            <div class="block-content">
                <table class="table table-striped table-bordered table-condensed">
                    <tbody>
                    @if($venta->remision > 0)
                        @foreach($venta->ingreso_remision as $ingreso)
                            <tr>
                                <td align="center" class="font-w600">{{ $ingreso->formas_pago->forma_pago }}</td>
                                <td align="center">${{ number_format($ingreso->valor) }}</td>
                                <td align="center">
                                    <a class='btn btn-primary btn-xs' href='ingresos/{{$ingreso->id}}'
                                       data-toggle="tooltip" data-original-title="Ir a ingreso">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($venta->ingreso_venta as $ingreso)
                            <tr>
                                <td align="center" class="font-w600">{{ $ingreso->formas_pago->forma_pago }}</td>
                                <td align="center">${{ number_format($ingreso->valor) }}</td>
                                <td align="center">
                                    <a class='btn btn-primary btn-xs' href='ingresos/{{$ingreso->id}}'
                                       data-toggle="tooltip" data-original-title="Ir a ingreso">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <a class="block block-link-hover2" href="javascript:void(0)">
            <div class="block-content block-content-full bg-primary clearfix">
                <i class="fa fa-usd fa-2x text-white pull-left"></i>
                <span class="h4 font-w700 text-white">Rentabilidad :</span>
                <span class="h4 text-white-op">{{ number_format($venta->venta +$venta->iva - $venta->compra)  }}</span>
            </div>
        </a>
    </div>
    @if($venta->remision <> 1)
        @if($venta->factura_venta->remision_id > 0)
            <div class="col-sm-4">
                <a class="block block-link-hover2" href="{{ $venta->factura_venta->remision_id }}">
                    <div class="block-content block-content-full bg-danger clearfix">
                        <span class="h4 font-w700 text-white"> Remision :</span>
                        <span class="h4 text-white-op">Si tiene</span>
                    </div>
                </a>
            </div>
        @endif
    @endif

@stop

@section('scripts')
@stop