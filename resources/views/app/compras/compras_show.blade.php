@extends('layouts.master')

@section('title')Compra #{{$compras->factura}}
@stop
@section('description')
@stop
@section('style')
@stop
@section('breadcrumb')
    <li><a href="{{url('compras')}}">compras</a></li>
@stop

@section('content')

    @include('app.compras.compras_invoice')

@stop
@section('scripts')

@stop
