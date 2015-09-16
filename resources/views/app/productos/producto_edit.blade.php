@extends('layouts.master')

@section('title')Editar Producto
@stop

@section('description')
@stop

@section('style')



@stop

@section('breadcrumb')<li><a href="{{url('productos')}}">Productos</a></li>
@stop

@section('content')
    <div class='block block-themed'>
        <div class="block-header bg-primary">
            <h3 class="block-title">Información Básica del producto</h3>
        </div>
        <div class="block-content">
            {!! Form::model($producto,['method'=>'PATCH','files'=>'true','action'=>['ProductosController@update',$producto->id]]) !!}
            {{-- formulario de prodcuto sirve para editar y crear --}}
            @include('app/productos/productoForm',['block'=>''])
            <div class="form-group row text-center">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-lg',
                'id'=>'crear_producto']) !!}
                <a class="btn btn-lg btn-danger" href="{{ URL::previous() }}">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('app/marcas/formulario_marca')
    @include('app/categorias/formulario_categoria')
@stop

@section('scripts')

@stop
