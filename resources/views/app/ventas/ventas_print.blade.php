@extends('layouts.master')

@section('title')

@stop

@section('description')
@stop

@section('style')
    <style type="text/css">
        p {
            line-height: 1 !important;
        }
    </style>

@stop

@section('breadcrumb')
    <li><a href="{{url('ventas')}}">ventas</a></li>
@stop

@section('content')
    @include('app.ventas.ventas_invoice')
@stop

@section('scripts')
@stop