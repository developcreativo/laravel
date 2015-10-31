@extends('layouts.master')

@section('title')Cajas
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    <div class="row">
        @if(!isset($caja_abierta))
            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover2 text-center" href="#" data-toggle="modal" data-target="#AbrirCaja">
                    <div class="block-content block-content-full bg-success">
                        <i class="si si-lock-open fa-4x text-white"></i>

                        <div class="font-w600 text-white-op push-15-t">Abrir Caja</div>
                    </div>
                </a>
            </div>
        @endif
        @if(isset($caja_abierta))
            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover2 text-center" href="#" data-toggle="modal" data-target="#CerrarCaja">
                    <div class="block-content block-content-full bg-city">
                        <i class="si si-lock fa-4x text-white"></i>

                        <div class="font-w600 text-white-op push-15-t">Cerrar Caja</div>
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover2 text-center" href="caja/{{ $caja_abierta->id }}">
                    <div class="block-content block-content-full bg-primary">
                        <i class="si si-magnifier fa-4x text-white"></i>

                        <div class="font-w600 text-white-op push-15-t">Ver Detalle</div>
                    </div>
                </a>
            </div>
        @endif
        <div class="col-sm-6">
            <a class="block block-link-hover2" href="#">
                <table class="block-table text-center">
                    <tbody>
                    <tr>
                        <td style="width: 70%;">
                            @if(isset($caja_abierta))
                                <div class="h1 font-w700">
                                    <span class="h2 text-muted">$</span> {{ number_format($saldo['Saldo']) }}
                                </div>
                                <div class="h5 text-muted text-uppercase push-5-t">En caja</div>
                            @else
                                <div class="h1 font-w700">Caja Cerrada</div>
                            @endif
                        </td>
                        <td class="bg-success" style="width: 30%;">
                            <div class="push-30 push-30-t">
                                <i class="si si-wallet fa-3x text-white-op"></i>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </a>
        </div>
    </div>
    <div class='block block-themed'>
        <div class="block-header bg-primary-light">
            <h3 class="block-title">Tabla de @yield('title')</h3>
        </div>
        <div class="block-content table-responsive">
            <table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="cajas">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">tienda</th>
                    <th class="text-center">Apertura</th>
                    <th class="text-center">Cierre</th>
                    <th class="text-center">Estado</th>
                    <th class="hidden-xs text-center">Descuadre</th>
                    <th class="hidden-sm hidden-xs text-center"><i class="fa fa-calendar-o"></i></th>
                    <th class="hidden-xs text-center">Responsable</th>
                    <th class="text-center">action</th>
                </tr>
                </thead>

                <tbody id="tabla-todos">
                @foreach($cajas as $caja)
                    <tr>
                        <td class="font-w600 text-center"><a href="caja/{{$caja->id}}">{{$caja->id}}</a></td>
                        <td class="font-w600 text-center"><a href="caja/{{$caja->id}}">{{$caja->tiendas->tienda}}</a>
                        </td>
                        <td class="text-center font-w600 text-success">${{number_format($caja->apertura)}} </td>
                        <td class="text-center font-w600 text-success">${{number_format($caja->cierre)}} </td>
                        <td class="text-center">
                            @if($caja->estado == 1)
                                <span class="label label-warning">Abierto</span>
                            @else
                                <span class="label label-success">Cerrado</span>
                            @endif
                        </td>
                        <td class="hidden-xs text-center ">
                            @if($caja->descuadre == 1)
                                <span class="label label-danger"><i class="fa fa-times-circle"></i> Si</span>
                            @else
                                <span class="label label-success"><i class="fa fa-check"></i> No</span>
                            @endif
                        </td>
                        <td class="hidden-sm hidden-xs text-center">{{str_limit($caja->created_at, $limit=10, $end='') }}</td>
                        <td class="text-center">{{ $caja->usuarios->name }}   </td>
                        <td class="text-center">
                            <a class='btn btn-warning btn-xs' href='caja/{{$caja->id}}/edit' data-toggle="tooltip"
                               data-original-title="Editar">
                                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                            </a>
                            <a class='btn btn-danger btn-xs' href='caja/{{$caja->id}}/delete' data-toggle="tooltip"
                               data-original-title="Eliminar">
                                <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                            </a>
                            <a class='btn btn-info btn-xs' href='caja/{{$caja->id}}' data-toggle="tooltip"
                               data-original-title="Imprimir">
                                <span class='glyphicon glyphicon-print' aria-hidden='true'></span>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>



    @include('app/cajas/caja_create')
    @include('app/cajas/caja_cerrar')
@stop

@section('scripts')
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}
@stop