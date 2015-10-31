@extends('layouts.master')

@section('title')
    Caja #{{$caja->id}}
    @if($caja->estado == 1)<span class="label label-success">Abierta</span>
    @else <span class="label label-danger">Cerrada</span>
    @endif
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
    <li><a href="{{url('caja')}}">Cajas</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                    </ul>
                    <h3 class="block-title">Cuadre de Caja #{{$caja->id}}
                        <span class="pull-right">Fecha: {{str_limit($caja->created_at, $limit=10, $end='') }} </span>
                    </h3>
                </div>
                <div class="block-content form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Responsable:</label>

                            <div class="input-group">
                                <!---  Field --->
                                <div class="input-group-addon"><i class="fa fa-user"></i>
                                </div>
                                <input class="form-control" readonly="readonly" type="text"
                                       value="{{ $caja->usuarios->name }}">
                            </div>

                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label>Fecha Apertura:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control" readonly="readonly" type="text"
                                       value="{{ $caja->created_at }}">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label>Fecha Vencimiento:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control" readonly="readonly" type="text"
                                       value="{{ $caja->created_at }}">
                            </div>
                        </div>


                    </div>
                    <div class="pull-r-l">
                        <table class="block-table text-center">
                            <tbody>
                            <tr>
                                <td class="border-r bg-success" style="width: 33%">
                                    <div class="h1 font-w700 text-white"><span
                                                class="h2 text-white-op">$</span>{{number_format($caja->apertura)}}
                                    </div>
                                    <div class="h5 text-white-op text-uppercase push-5-t">Apertura de Caja</div>
                                </td>
                                <td class="bg-warning border-r">
                                    <div class="h1 font-w700 text-white"><span
                                                class="h2 text-white-op">$</span>{{number_format($caja->cierre)}}</div>
                                    <div class="h5 text-white-op text-uppercase push-5-t">Cierre de Caja</div>
                                </td>
                                <td class="bg-danger border-r" style="width: 33%">
                                    <div class="h1 font-w700 text-white"><span
                                                class="h2 text-white-op">$</span>{{number_format($caja->cierre - $saldo['Saldo'])}}
                                    </div>
                                    <div class="h5 text-white-op text-uppercase push-5-t">Descuadre de Caja</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-bordered table-condensed">
                        <tbody>
                        @foreach($movimientos as $movimiento)
                            <tr>
                                <td align="center" class="font-w600">{{ substr($movimiento->created_at,10,6) }}</td>
                                <td align="center" class="">{{ $movimiento->concepto }}</td>
                                <td align="center" class="font-w600">${{number_format($movimiento->valor)}}</td>
                                <td align="center">
                                    <a class="btn btn-primary btn-xs" href="ingresos/62" data-toggle="tooltip"
                                       data-original-title="Ir a ingreso">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-xs-6 col-sm-2">
            <a class="block block-link-hover2 text-center" href="http://localhost/ventas/print/80">
                <div class="block-content block-content-full bg-amethyst">
                    <i class="si si-printer fa-4x text-white"></i>

                    <div class="font-w600 text-white-op push-15-t">Imprimir</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-sm-2">
            <a class="block block-link-hover2 text-center" type="buttom" href="#" data-toggle="modal"
               data-target="#modal-email">
                <div class="block-content block-content-full bg-city">
                    <i class="si si-envelope fa-4x text-white"></i>

                    <div class="font-w600 text-white-op push-15-t">Enviar</div>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="block block-themed">
                <div class="block-header bg-success">
                    <h3 class="block-title">Resumen de Caja: </h3>
                </div>
                <div class="block-content">
                    <div class="pull-r-l pull-t">
                        <table class="block-table text-center bg-gray-lighter border-b">
                            <tbody>
                            <tr>
                                <td class="border-r" style="width: 50%;">
                                    <div class="h4 font-w600 push-5 push-5-t">Apertura Caja</div>

                                </td>
                                <td>
                                    <div class="h4 font-w700 text-success">
                                        ${{ number_format($saldo['Apertura']) }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-r border-t" style="width: 50%;">
                                    <div class="h4 font-w600 push-5 push-5-t">Ventas efectivo</div>

                                </td>
                                <td class="border-t">
                                    <div class="h4 font-w700 text-success">
                                        ${{ number_format($saldo['Efectivo']) }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-r border-t" style="width: 50%;">
                                    <div class="h4 font-w600 push-5 push-5-t">Ventas Tarjeta</div>

                                </td>
                                <td class="border-t">
                                    <div class="h4 font-w700 text-muted">${{ number_format($saldo['Tarjeta']) }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-r border-t" style="width: 50%;">
                                    <div class="h4 font-w600 push-5 push-5-t">Ventas Crédito</div>

                                </td>
                                <td class="border-t">
                                    <div class="h4 font-w700 text-muted">${{ number_format($saldo['Crédito']) }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-r border-t" style="width: 50%;">
                                    <div class="h4 font-w600 push-5 push-5-t">Salida Efectivo</div>

                                </td>
                                <td class="border-t">
                                    <div class="h4 font-w700 text-danger">${{ number_format($saldo['Egreso']) }}</div>
                                </td>
                            </tr>
                            <tr class="bg-success">
                                <td class="border-r border-t" style="width: 50%;">
                                    <div class="h3 font-w700 push-5 push-5-t text-white">Saldo</div>

                                </td>
                                <td class="border-t">
                                    <div class="h3 font-w700 text-white">${{ number_format($saldo['Saldo']) }}</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block-content">
                    <h4 class="push-10">Notas de Apertura y Cierre:</h4>
                    <div class="alert alert-success">
                        <p> <i class="fa fa-info-circle"></i> {{ $caja->nota_apertura }}</p>
                    </div>
                    <div class="alert alert-info">
                        <p> <i class="fa fa-info-circle"></i> {{ $caja->nota_cierre }}</p>
                    </div>
                </div>

            </div>
        </div>


    </div>



@stop

@section('scripts')
@stop