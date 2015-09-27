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
        <table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="ventas">
            <thead>
            <tr>
                <th class="text-center">Factura</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Tienda</th>
                <th class="text-center">fecha</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Valor</th>
                <th class="text-center">action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($ventas as $venta)

                <tr>
                    <td class="font-w600 text-center"><a href='ventas/{{$venta->id}}'>{{$venta->factura}}</a></td>
                    <td class="font-w600 text-center">{{$venta->clientes->cliente}} </td>
                    <td class="text-center">{{$venta->tiendas->tienda}} </td>
                    <td class="text-center">{{str_limit($venta->created_at, $limit = 10, $end = '')}} </td>
                    <td class="text-center">@if($venta->pagado == 1)<span class="label label-success">Pagado</span>
                        @else<span class="label label-danger">Pendiente</span>
                        @endif
                    </td>
                    <td class="text-center font-w600 text-success">${{ number_format($venta->venta) }}</td>
                    <td class="text-center">
                        <a class='btn btn-warning btn-xs' href='ventas/{{$venta->factura_venta->id}}/edit' data-toggle="tooltip" data-original-title="Editar"><span
                                    class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                        <a class='btn btn-danger btn-xs' href='ventas/delete/{{$venta->factura_venta->id}}' data-toggle="tooltip" data-original-title="Eliminar"><span
                                    class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        <a class='btn btn-default btn-xs' href='ventas/{{$venta->factura_venta->id}}/print' data-toggle="tooltip" data-original-title="Imprimir"><span
                                    class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
                        <a class='btn btn-info btn-xs' href='ventas/pos/{{$venta->factura_venta->id}}' data-toggle="tooltip" data-original-title="Imprimir POS"><span
                                    class='si si-energy' aria-hidden='true'></span></a>
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