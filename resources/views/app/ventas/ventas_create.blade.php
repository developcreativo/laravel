@extends('layouts.master')

@section('title')Nueva venta
@stop

@section('description')
@stop

@section('style')
    {!! HTML::style('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')!!}
@stop

@section('breadcrumb')
    <li><a href="{{url('ventas')}}">Ventas</a></li>
@stop

@section('content')

    {!! Form::open(['action'=>'VentaController@store','class' => 'js-validation-ventas']) !!}
    <div class="block block-themed">
        <div class="block-header bg-primary">
            <h3 class="block-title">Crear factura</h3>
        </div>
        <div class="block-content form-horizontal" style="overflow: auto;">
            <div class="col-sm-2">
                <buttom class="btn btn-block btn-lg btn-default" data-toggle="modal" data-target="#clientes-modal"><i
                            class="si si-users fa-3x"></i></buttom>
            </div>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <!---  Field --->
                                {!! Form::hidden('cliente_id', null, ['class' => 'cliente_id']) !!}
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                {!! Form::text('cliente', null, ['class' => 'form-control cliente','placeholder'=>'Nombre del cliente']) !!}
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-info"></i></div>
                                {!! form::text('documento', null , ['class' => 'form-control documento','placeholder'=>'Nit o Cedula'])!!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                {!! form::text('telefono', null , ['class' => 'form-control telefono','placeholder'=>'(000)-(0000000)'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <!--- Correo Field --->
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                                {!! form::email('email', null , ['class' => 'form-control email','placeholder'=>'Correo electrónico'])!!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                {!! form::text('vencimiento', null , ['class' => 'form-control js-datepicker',
                                'data-date-format'=>'yyyy-mm-dd','placeholder'=>'Vence'])!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-gray-lighter">
            <div class="row">
                <div class="col-sm-9">
                    <div class="input-group input-group-lg">
                        {!! Form::text('buscar', null, ['class' => 'form-control','placeholder'=>'Buscar por...',
                        'id'=>'buscar','autocomplete'=>'off']) !!}
                        <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
                    </div>

                    <ul class="list-group" id="productos-sugeridos" data-productos="{{ $productos }}">
                    </ul>
                </div>
                <div class="col-sm-3">
                    {!! form::select('tienda', $tiendas, null, ['class' => 'form-control input-lg'])!!}
                </div>
            </div>
        </div>
        <div class="block-content push-15">

            <div class="row">
                <div class="table-responsive col-sm-12">
                    <table class="table table-condensed table-striped table-bordered dataTable" role="grid"
                           id='compras'
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th width="8%" class="text-center">COD</th>
                            <th width="8%" class="text-center">Cant</th>
                            <th width="30%" class="text-center">Producto</th>
                            <th class="text-center">valor</th>
                            <th width="10%" class="text-center">IVA</th>
                            <th width="10%" class="text-center">DTO</th>
                            <th width="14%" class="text-center">Sub</th>
                            <th width="8%" class="text-center">Act</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>Sub-Total</strong></td>
                            <td colspan="2"><strong>
                                    {!! Form::number('subtotal', 0, ['class' => 'form-control input-sm','id' => 'subT',
                                    'readonly'])!!}
                                </strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>IVA</strong></td>
                            <td colspan="2">{!! Form::text('iva', 0, ['class' => 'form-control input-sm','id' => 'iva','readonly']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>DTO</strong></td>
                            <td colspan="2">{!! Form::text('descuento', 0, ['class' => 'form-control input-sm','id' => 'DTO','readonly']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"></tdcolspan><strong>Rete-Fuente</strong>
                            </td>
                            <td colspan="2"><strong>
                                    {!! Form::text('retefuente', 0, ['class' => 'form-control input-sm','id'=>'rete', 'onkeyup'=>'obtenerDatos()']) !!}
                                </strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>Total</strong></td>
                            <td colspan="2">
                                <strong>
                                    {!! Form::text('total', 0, ['class' => 'form-control','id' => 'total','readonly']) !!}
                                </strong>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody id="tabla-todos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="block-header bg-primary">
            <h3 class="block-title pull-left push-10-r">Despacho: </h3>

            <div class="pull-left"><label class="css-input switch switch-sm switch-success remove-margin">
                    <input type="checkbox" name="despacho" id="despacho" value="1"><span></span>
                </label>
            </div>
        </div>
        <div class="block-content form-horizontal" id="content_despacho" style="overflow: auto;">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-addon">Dirección:</div>
                            {!! Form::text('direccion', null, ['class' => 'form-control direccion','placeholder'=>'Dirección completa de destino']) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">Departamento:</div>
                            {!! form::select('departamento', $departamentos, null, ['class' => 'form-control departamento'])!!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">Ciudad:</div>
                            <select name="ciudad" class="form-control ciudad" data-ciudad="{{ $ciudades }}"></select>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- busqueda del producto-->
    <!-- detalles de la factura-->
    <div class="col-sm-4 col-sm-offset-4 push-30">
        <buttom class="btn btn-primary btn-lg btn-block" onclick="abrir_pagos()">Realizar pago</buttom>
    </div>
    @include('app.ventas.ventas_pos_pagos')
    {!! Form::close() !!}
            <!-- Modal clientes-->
    <div class="modal fade" id="clientes-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Clientes</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Buscar cliente..."
                               aria-describedby="sizing-addon1" id="buscar_cliente">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
                    </div>

                    <table class="table table-striped table-condensed table-bordered js-dataTable-full" role="grid"
                           id='clientes'
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th hidden>COD</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td hidden>{{$cliente->id}}</td>
                                <td>{{$cliente->documento}}</td>
                                <td>{{ str_limit($cliente->cliente, $limit = 20, $end = '...')}} </td>
                                <td>{{ $cliente->email}} </td>
                                <td>
                                    <a class='btn btn-success btn-xs' href='#' role='button'
                                       onclick='AgCliente("{{$cliente->id}}","{{$cliente->documento}}","{{$cliente->cliente}}",
                                               "{{$cliente->email}}","{{$cliente->telefono}}","{{$cliente->direccion}}")'
                                       data-dismiss="modal">
                                        <span class='fa fa-check-square-o' aria-hidden='true'></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('js/ventas.js')!!}
    {!! HTML::script('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')!!}
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}
    <script>
        $(function () {
            App.initHelper('datepicker');
        });

    </script>

@stop