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
            <input type="text" class="form-control" placeholder="Buscar compra..."
                   aria-describedby="sizing-addon1" id="buscar_compra">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="{{ URL::to('compras/create')}}" class="btn btn-lg btn-primary btn-block">
            <i class="fa fa-plus"></i><span>  Nueva compra</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de @yield('title')</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="compras">
            <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Tienda</th>
                <th>fecha</th>
                <th>Estado</th>
                <th>action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($ventas as $venta)

                <tr>
                    <td>{{$venta->id}}</td>
                    <td>{{$venta->clientes->cliente}} </td>
                    <td>{{$venta->tiendas->tienda}} </td>
                    <td>{{str_limit($venta->created_at, $limit = 10, $end = '')}} </td>
                    <td>@if($venta->pagado == 1)<span class="label label-success">Pagado</span>
                        @else<span class="label label-danger">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='ventas/{{$venta->id}}/edit' role='button'><span
                                    class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                        <a class='btn btn-danger btn-sm' href='ventas/delete/{{$venta->id}}' role='button'><span
                                    class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        <a class='btn btn-info btn-sm' href='ventas/{{$venta->id}}/print' role='button'><span
                                    class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}

@stop