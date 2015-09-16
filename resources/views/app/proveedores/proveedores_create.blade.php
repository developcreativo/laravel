@extends('layouts.master')

@section('title')Crear proveedor
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')<li><a href="{{url('proveedores')}}">proveedores</a></li>
@stop

@section('content')
    <div class="col-sm-12">
        <div class="block block-themed">
            <div class="block-header bg-primary">
                <h3 class="block-title">Crear Proveedor</h3>
            </div>
            <div class="block-content">
                {!! Form::open(['class'=>'form-horizontal push-5-t js-validation-proveedor','action'=>'ProveedoresController@store']) !!}
                @include('app.proveedores.proveedores_formulario')
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4 push-30">
                        {!! Form::submit('Agregar', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/validation/proveedores.js')!!}
@stop