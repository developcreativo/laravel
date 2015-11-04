@extends('layouts.master')

@section('title')Ingresos
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    {!! Form::open(['class'=>'form-horizontal','action'=>'IngresosController@store']) !!}
    <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
            <li class="active">
                <a href="#btabs-alt-static-justified-home"><i class="fa fa-barcode"></i> Ingresos</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-profile"><i class="fa fa-cubes"></i> Ingresos X Factura</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-settings"><i class="fa fa-bar-chart"></i> Estadisticas</a>
            </li>
        </ul>

        <div class="block-content tab-content">

            <div class="tab-pane active" id="btabs-alt-static-justified-home">
                @include('app.ingresos.ingresos_create_ingreso')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-profile">
                @include('app.ingresos.ingesos_create_factura')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-settings">

            </div>

        </div>
    </div>
    @include('app.ventas.ventas_pos_pagos')
    {!! Form::close() !!}





@stop

@section('scripts')
    {!! HTML::script('js/ingresos.js')!!}
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}

@stop