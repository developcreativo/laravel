@extends('layouts.master')

@section('title')Imprimir
@stop
@section('description')
@stop
@section('style')
@stop
@section('breadcrumb')
    <li><a href="{{url('compras')}}">compras</a></li>
    <li><a href="{{url('compras/'.$compra->id)}}">#{{ $compra->factura }}</a></li>
@stop

@section('content')

    @include('app.compras.compras_invoice')

@stop
@section('scripts')

@stop
