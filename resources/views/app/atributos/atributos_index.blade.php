@extends('layouts.master')

@section('title')
    Atributos
@stop

@section('description')
@stop

@section('style')
    <link rel="stylesheet" href="{{url('assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css')}}">
@stop

@section('breadcrumb')

@stop

@section('content')
    <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
            <li class="active">
                <a href="#btabs-alt-static-justified-marcas"><i class="fa fa-barcode"></i> Marcas</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-categorias"><i class="fa fa-cubes"></i> Categorias</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-atributos"><i class="fa fa-bar-chart"></i> Atributos</a>
            </li>
            <li>
                <a href="#btabs-alt-static-justified-impuestos"><i class="fa fa-bar-chart"></i> Impuestos</a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="btabs-alt-static-justified-marcas">
                @include('app.atributos.atributos_marcas')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-categorias">
                @include('app.atributos.atributos_categorias')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-atributos">
                @include('app.atributos.atributos_atributos')
            </div>
            <div class="tab-pane" id="btabs-alt-static-justified-impuestos">
                @include('app.atributos.atributos_impuestos')
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}
    {!! HTML::script('assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')!!}
    {!! HTML::script('assets/js/validation/impuestos.js')!!}
@stop