@extends('layouts.master')

@section('title')Crear Producto
@stop

@section('description')
@stop

@section('style')

    <link rel="stylesheet" href="../assets/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/js/plugins/select2/select2-bootstrap.min.css">

@stop

@section('breadcrumb')<li><a href="{{url('productos')}}">Productos</a></li>
@stop

@section('content')
    <div class='block block-themed'>
        <div class="block-header bg-primary">
            <h3 class="block-title">Información Básica del producto</h3>
        </div>
        <div class="block-content">
            {!! Form::open(['files'=>'true','action'=>'ProductosController@store']) !!}
            {{-- formulario de prodcuto sirve para editar y crear --}}
            @include('app/productos/productoForm',['block'=>''])
            <div class="form-group row text-center">
                {!! Form::submit('Agregar', ['class' => 'btn btn-primary btn-lg',
                'id'=>'crear_producto','data-loading-text'=>'Creando...']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('app/marcas/formulario_marca')
    @include('app/categorias/formulario_categoria')
@stop

@section('scripts')

@stop
