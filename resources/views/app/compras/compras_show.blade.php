@extends('layouts.master')

@section('title')
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
    <li><a href="{{url('compras')}}">Compras</a></li>
@stop

@section('content')
    <div class="col-sm-8">
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title"><i class="fa fa-newspaper-o"></i>
                    Factura: {{ $compra->factura }}
                    <span class="pull-right">Fecha: {{ $compra->created_at }}</span></h3>

            </div>
            <div class="block-content form-horizontal">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <!---  Field --->
                            {!! Form::hidden('proveedor_id', null, ['class' => 'proveedor_id']) !!}
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('proveedor', $compra->proveedor->proveedor, ['class' => 'form-control','readonly']) !!}
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-info"></i></div>
                            {!! form::text('nit', $compra->proveedor->nit , ['class' => 'form-control',
                            'placeholder'=>'Nit o Cedula','readonly'])!!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! form::text('vencimiento', $compra->fecha_vencimiento , ['class' => 'form-control',
                            'data-date-format'=>'yyyy-mm-dd','placeholder'=>'Vence','readonly'])!!}
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <!--- Correo Field --->
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            {!! form::email('email', $compra->proveedor->email , ['class' => 'form-control',
                            'placeholder'=>'Correo electrónico','readonly'])!!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            {!! form::text('telefono', $compra->proveedor->telefono , ['class' => 'form-control',
                            'placeholder'=>'(000)-(0000000)','readonly'])!!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header bg-primary">
                <h3 class="block-title">Detalle: </h3>
            </div>
            <div class="block-content table-responsive">
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

        </div>
    </div>
    <div class="col-xs-6 col-sm-2">
        <a class="block block-link-hover2 text-center" href="{{ url('compras/print/'.$compra->id) }}">
            <div class="block-content block-content-full bg-amethyst">
                <i class="si si-printer fa-4x text-white"></i>

                <div class="font-w600 text-white-op push-15-t">Imprimir</div>
            </div>
        </a>
    </div>
    <div class="col-xs-6 col-sm-2">
        <a class="block block-link-hover2 text-center" type="buttom" href="#" data-toggle="modal"
           data-target="#modal-email">
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
                    @foreach($compra->egresos as $egreso)
                        <tr>
                            <td align="center" class="font-w600">{{ $egreso->formas_pago->forma_pago }}</td>
                            <td align="center">${{ number_format($egreso->valor) }}</td>
                            <td align="center">
                                <a class='btn btn-primary btn-xs' href='egresos/{{$egreso->id}}'
                                   data-toggle="tooltip" data-original-title="Ir a ingreso">Ver</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                @if($compra->pagado < $compra->valor_total)
                    {!! Form::open(['method'=>'put','action'=>['ComprasController@pagar',$compra->id]]) !!}
                    <div align="center">
                        <button id="pagar" class="btn btn-success push-15" onclick="abrir_pagos()" data-pago="{{$compra->valor_total - $compra->pagado}}">
                            <i class="fa fa-plus"></i> Agregar pago
                        </button>
                    </div>
                    @include('app.ventas.ventas_pos_pagos')
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
    @include('app.compras.compras_modal_email')
@stop

@section('scripts')
    {!! HTML::script('js/pagos_compras.js')!!}
@stop