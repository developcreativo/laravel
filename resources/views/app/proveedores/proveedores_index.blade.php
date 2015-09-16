@extends('layouts.master')

@section('title')
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Buscar proveedor..."
                       aria-describedby="sizing-addon1" id="buscar_proveedor">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <a href="{{ url('proveedores/create') }}" class="btn btn-lg btn-primary btn-block" >
                <i class="fa fa-plus"></i><span>  Nuevo proveedor</span>
            </a>
        </div>
    </div>
    <br>
    <div class='block block-themed'>
        <div class="block-header bg-primary-light">
            <h3 class="block-title">Tabla de Proveedores</h3>
        </div>
        <div class="block-content table-responsive">
            <table class="table js-dataTable-full table-striped table-condensed" id="proveedores">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Proveedor</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($proveedores as $proveedor)

                    <tr id="proveedor_{{$proveedor->id}}">
                        <td>{{$proveedor->id}}</td>
                        <td class="font-w600"><a href="proveedores/{{ $proveedor->id }}">{{$proveedor->proveedor}}</a></td>
                        <td>{{$proveedor->contacto}}</td>
                        <td>{{$proveedor->email}}</td>
                        <td>{{$proveedor->telefono}}</td>
                        <td>
                            <a class='btn btn-warning btn-xs' href='marcas/{{$proveedor->id}}/edit' role='button'>
                                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                            </a>
                            <a class='btn btn-danger btn-xs' href='#' data-toggle="modal"  data-target="#modal-delete-proveedor"
                               onclick="borrar({{$proveedor->id}})">
                            <span class='glyphicon glyphicon-trash' data-toggle="tooltip"
                                  data-original-title='Eliminar' aria-hidden='true'></span>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @include('app.proveedores.proveedores_delete')

@stop

@section('scripts')

@stop