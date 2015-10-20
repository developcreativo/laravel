@extends('layouts.master')

@section('title')Ventas
@stop
@section('style')

@stop

@section('content')
        <!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-9 col-xs-12">
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Buscar venta..."
                   aria-describedby="sizing-addon1" id="buscar_venta">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="{{ URL::to('ventas/create')}}" class="btn btn-lg btn-primary btn-block">
            <i class="fa fa-plus"></i><span>  Nueva venta</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de @yield('title')</h3>
    </div>
    <div class="block-content table-responsive">
        @include('app.ventas.tabla_ventas')
    </div>
</div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}

@stop