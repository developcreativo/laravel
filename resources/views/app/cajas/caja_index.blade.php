@extends('layouts.master')

@section('title')Caja
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    <div>

        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="#" role="button" data-toggle="modal" data-target="#AbrirCaja">
                    <i class="fa-check"></i><span> Abrir caja </span></a>
            </li>
        </ul>
    </div>

    @include('app/cajas/caja_create')
@stop

@section('scripts')
@stop