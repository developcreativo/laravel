@extends('layouts.master')

@section('title')Compras
@stop
@section('style')

@stop

@section('content')
        <!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-6 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-success">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{ number_format($datos['pagado']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-up text-success"></i> Pagos realizados
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-warning">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{ number_format($datos['pendiente']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-down text-warning"></i> Pagos pendientes
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-danger">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{number_format( $datos['vencido']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-down text-danger"></i> Compras vencidas
            </div>
        </a>
    </div>
</div>
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
                <th hidden>id</th>
                <th class="text-center">Factura</th>
                <th class="text-center">Proveedor</th>
                <th class="text-center">valor</th>
                <th class="text-center">Vence</th>
                <th class="hidden-xs text-center">Pagado</th>
                <th class="hidden-sm hidden-xs text-center"><i class="fa fa-calendar-o"></i></th>
                <th class="hidden-xs text-center">Bodega</th>
                <th class="text-center">Estado</th>
                <th class="text-center">action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($compras as $compra)
                <tr>
                    <td hidden>{{$compra->id}}</td>
                    <td class="text-center"><a href="compras/{{$compra->id}}">{{$compra->factura}}</a></td>
                    <td class="font-w600 text-center">{{$compra->proveedor->proveedor}} </td>
                    <td class="text-center font-w600 text-success">${{number_format($compra->valor_total)}} </td>
                    <td class="text-center">{{$compra->fecha_vencimiento}} </td>
                    <td class="hidden-xs text-center ">${{number_format($compra->pagado)}} </td>
                    <td class="hidden-sm hidden-xs text-center">@if($compra->remision == 1) SI @else NO @endif</td>
                    <td class="hidden-xs text-center">{{$compra->tienda->tienda}} </td>
                    <td class="text-center">
                        @if($compra->pagado < $compra->valor_total)
                            @if(strtotime($compra->fecha_vencimiento) < time()) <span class="label label-danger">Vencida</span>
                            @else <span class="label label-warning">Pendiente</span>
                            @endif
                        @else <span class="label label-success">Pagada</span> @endif
                    </td>
                    <td class="text-center">
                        <a class='btn btn-warning btn-xs' href='compras/{{$compra->id}}/edit' data-toggle="tooltip"
                           data-original-title="Editar">
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                        <a class='btn btn-danger btn-xs' href='compras/{{$compra->id}}/delete' data-toggle="tooltip"
                           data-original-title="Eliminar">
                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        <a class='btn btn-info btn-xs' href='compras/{{$compra->id}}' data-toggle="tooltip"
                           data-original-title="Imprimir">
                            <span class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
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