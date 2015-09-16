@extends('layouts.master')

@section('title'){{$producto->producto}}
@stop

@section('description')
@stop

@section('style')


@stop

@section('breadcrumb')
    <li><a href="{{url('productos')}}">Productos</a></li>
@stop

@section('content')

    <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
            <li class="active">
                <a href="#btabs-alt-static-justified-home"><i class="fa fa-barcode"></i> Producto</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-profile"><i class="fa fa-cubes"></i> Variables</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-settings"><i class="fa fa-bar-chart"></i> Estadisticas</a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="btabs-alt-static-justified-home">
                @include('app/productos/producto_show_producto')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-profile">
                @include('app/productos/producto_show_variables')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-settings">
                @include('app/productos/producto_show_estadisticas')
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/chartjs/Chart.min.js')!!}
@stop