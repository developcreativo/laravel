@extends('layouts.master')

@section('title')
@stop

@section('description')
@stop

@section('style')
    <style type="text/css">

    </style>
@stop

@section('breadcrumb')
    <li><a href="{{url('ventas')}}">Ventas</a></li>
@stop

@section('content')
    @include('app.ventas.ventas_pos_clientes')
    <div class="col-sm-2">
        <div class="block block-themed">
            <div class="block-header bg-primary">
                <h2 class="block-title text-center">Categorías</h2>
            </div>
            <div class="push-10-t">
                @foreach($categorias as $categoria)
                    <?php $n = $categoria->level; $whole = floor($n); $fraction = $n - $whole; ?>
                    @if(!$fraction > 0)
                        <buttom onclick="categoria({{ $categoria->id }})"
                                class="btn btn-block btn-success btn-lg">{{ $categoria->categoria }}</buttom>
                    @else
                        <buttom data-subcategoria="true" onclick="categoria({{ $categoria->id }})"
                                class="btn btn-block btn-warning btn-lg categoria id_{{ $whole }}">{{ $categoria->categoria }}</buttom>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-7 ">
        <div class="block block-themed">
            <div class="buscador">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Buscar producto..."
                           aria-describedby="sizing-addon1" id="buscar_producto">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search"></span>
                </span>
                </div>
            </div>
            <buttom class="btn btn-block btn-info" onclick="buscador()" data-toggle="tooltip"
                    data-original-title="Activar el buscador">
                <span class="glyphicon glyphicon-search"></span>
            </buttom>

            <div class="productos_pos" data-productos="{{ $productos }}">
            </div>
        </div>

    </div>
    {!! Form::open(['action'=>'PosController@store']) !!}
    <div class="col-sm-3 ticket">
        <div class="block block-themed">
            <div class="block-content">

                <a data-toggle="modal" data-target="#clientes-modal" class=" btn btn-lg btn-default">
                    <i class="fa fa-user"></i><span class="hidden-sm hidden-md">  Cliente</span>
                </a>

                <a href="#" class="btn btn-lg btn-danger pull-right" data-toggle="tooltip"
                   data-original-title="Vaciar canasta"
                   onclick="vaciar()">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>


            </div>
            <div class="block-content">
                <div class="cliente">
                    <!--- cliente_id Field --->
                    {!! Form::hidden('cliente_id', null, ['class' => 'form-control','id'=>'cliente_id']) !!}
                            <!--- Nombre Field --->
                    <div class="form-group has-info">
                        {!! Form::text('cliente', null, ['class' => 'form-control
                        text-center','id'=>'nombre_cliente','placeholder'=>'Nombre de Cliente','readonly']) !!}
                    </div>
                </div>
                <div class="productos">
                </div>


            </div>
            <div class="totales">
                <table class="table table-striped table-condensed remove-margin-b">
                    <tr>
                        <td align="right" width="50%">Descuento:</td>
                        <td align="right"><!--- descuento Field --->
                            {!! Form::text('descuento', null, ['class' => 'form-control','id'=>'descuento'])!!}
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="50%">Sub-Total:</td>
                        <td align="right"><!--- iva Field --->
                            {!! Form::text('subtotal', null, ['class' => 'form-control','id'=>'subtotal', 'readonly'])
                            !!}
                        </td>
                    </tr>
                    <tr>
                        <td align="right">IVA:</td>
                        <td align="right">{!! Form::text('iva', null, ['class' => 'form-control','id'=>'IVA',
                            'readonly']) !!}
                        </td>
                    </tr>
                </table>

                <div class="btn btn-lg btn-primary btn-block text-center" onclick="abrir_pagos()"><span
                            class="total"><small>TOTAL:</small> $
                       </span>{!! Form::text('total', null, ['class' => 'total','id'=>'total', 'readonly'])
                    !!}
                </div>
            </div>
        </div>
    </div>
    @include('app.ventas.ventas_pos_pagos')
    {!! Form::close() !!}

@stop

@section('scripts')
    {!! HTML::script('js/POS.js')!!}
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}

@stop