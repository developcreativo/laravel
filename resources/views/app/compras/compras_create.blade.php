@extends('layouts.master')

@section('title')Nueva compra
@stop

@section('description')
@stop

@section('style')
    {!! HTML::style('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css')!!}
@stop

@section('breadcrumb')
    <li><a href="{{url('compras')}}">Compras</a></li>
@stop

@section('content')

    <div class="col-sm-6">
        <div class="block block-themed">
            <div class="block-header bg-success">
                <h3 class="block-title">Buscar productos</h3>
            </div>
            {!! Form::open(array('url'=>'compras/additem','id'=>'agregar')) !!}
            <div class="block-content">
                <div class="input-group input-group-lg">
                    {!! Form::text('buscar', null, ['class' => 'form-control','placeholder'=>'Buscar por...',
                    'id'=>'buscar','autocomplete'=>'off']) !!}
                    <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
                </div>

                <ul class="list-group" id="productos-sugeridos" data-productos="{{ $compras }}">
                </ul>

                {!! Form::close() !!}

            </div>

        </div>
    </div>
    <!-- busqueda del producto-->
    {!! Form::open(['onkeypress'=>'return anular(event)','action'=>'ComprasController@store','class' => 'js-validation-compras']) !!}
    <div class="col-sm-6">
        <div class="block block-themed">
            <div class="block-content form-horizontal">
                <div class="form-group">
                    <div class="col-sm-5">
                        {!! Form::label('factura', 'Numero Factura:') !!}
                        {!! Form::text('factura', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-7">
                        {!! Form::label('fecha', 'Fecha de Vencimiento:') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! form::text('fecha', null , ['class' => 'form-control js-datepicker',
                            'data-date-format'=>'yyyy-mm-dd','placeholder'=>'dd/mm/yy'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group-separator"></div>

                <div class="form-group">
                    <div class="col-sm-5">
                        {!! Form::label('Tienda', 'Tienda:') !!}
                        {!! form::select('tienda', $tiendas, null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="col-sm-5">
                        {!! Form::label('proveedor', 'Proveedor:') !!}
                        {!! form::select('proveedor', $proveedores, null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::label('remision', 'Remisión:') !!}
                        <label class="css-input switch switch-primary">
                            {!! Form::checkbox('remision', '1', null, ['class'=>'css-input switch switch-primary','data-toggle'=>'tooltip','data-original-title'=>'Si es remision seleccione aquí'])!!}
                            <span></span>
                        </label>

                    </div>

                </div>

            </div>
        </div>


    </div>
    <!-- detalles de la factura-->
    <div class="col-sm-12">
        <div class='block block-themed'>
            <div class="block-header bg-primary">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle"
                                data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </li>
                </ul>
                <h3 class="block-title"></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered dataTable" role="grid" id='compras'
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
                                    {!! Form::number('subT', 0, ['class' => 'form-control input-sm','id' => 'subT',
                                    'readonly'])!!}
                                </strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>IVA</strong></td>
                            <td colspan="2">{!! Form::text('IVA', 0, ['class' => 'form-control input-sm','id' => 'iva','readonly']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"><strong>DTO</strong></td>
                            <td colspan="2">{!! Form::text('DTO', 0, ['class' => 'form-control input-sm','id' => 'DTO','readonly']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-right v-center"></tdcolspan><strong>Rete-Fuente</strong></td>
                            <td colspan="2"><strong>
                                    {!! Form::text('rete', 0, ['class' => 'form-control input-sm','id'=>'rete',
                                    'onkeyup'=>'subtotal()']) !!}
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
    </div>
    <div class="col-sm-4 col-sm-offset-4 push-30">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    {!! HTML::script('js/search.js')!!}
    {!! HTML::script('assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')!!}
    {!! HTML::script('assets/js/pages/base_pages_compras.js')!!}
    <script>
        $(function () {
            App.initHelper('datepicker');
        });
    </script>

@stop