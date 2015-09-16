@extends('layouts.master')

@section('title'){{$proveedor->proveedor}}
@stop

@section('description')
@stop

@section('style')


@stop

@section('breadcrumb')
    <li><a href="{{url('proveedores')}}">Proveedores</a></li>
@stop

@section('content')

    <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
            <li class="active">
                <a href="#btabs-alt-static-justified-home"><i class="fa fa-barcode"></i> Proveedor</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-profile"><i class="fa fa-cubes"></i> Compras</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-settings"><i class="fa fa-bar-chart"></i> Estadisticas</a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="btabs-alt-static-justified-home">
                @include('app/proveedores/proveedores_show_proveedor')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-profile">
                @include('app/proveedores/proveedores_show_compras')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-settings">
                @include('app/proveedores/proveedores_show_estadisticas')
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/chartjs/Chart.min.js')!!}
    {!! HTML::script('assets/js/validation/proveedores.js')!!}
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}
@stop