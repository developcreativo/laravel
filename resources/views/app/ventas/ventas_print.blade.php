@extends('layouts.master')

@section('title')Imprimir

@stop

@section('description')
@stop

@section('style')
    <style type="text/css">
        p {
            line-height: 1 !important;
        }
        @media print {
            .comercio {
                font-size: 8px;
            }
            .bancos {
                font-size: 12px;
            }


        }
    </style>




@stop

@section('breadcrumb')
    <li><a href="{{url('ventas')}}">ventas</a></li>
    <li><a href="{{url('ventas/'.$venta->id)}}"># {{ $venta->factura }}</a></li>
@stop

@section('content')
    @include('app.ventas.ventas_invoice')
@stop

@section('scripts')
@stop