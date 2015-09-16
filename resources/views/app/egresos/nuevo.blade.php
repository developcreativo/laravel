@extends('layouts.master')

@section('style')
@stop
@section('title')Nuevo Egreso
@stop
@section('description')creacion de un nuevo egreso manual
@stop
@section('breadcrumb')<li><a href="{{url('egresos')}}">Egresos</a></li>
@stop


@section('content')

    <div class="panel panel-color panel-success">
        <div class="panel-heading">
            Nuevo Egreso
            <div class="panel-options">
                <a href="#"><i class="linecons-cog"></i> </a>
                <a href="#" data-toggle="panel"> <span class="collapse-icon">–</span> <span class="expand-icon">+</span>
                </a>
                <a href="#" data-toggle="reload"> <i class="fa-rotate-right"></i> </a>
                <a href="#" data-toggle="remove">×</a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                {!! Form::open(['url' => 'egresos','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! form::label('proveedor', 'Proveedor: ', ['class'=>'control-label col-sm-2 '])!!}
                    <div class="col-sm-4">
                        {!! form::text('proveedor_id', null, ['class' => 'form-control','placeholder'=>'Ingrese el proveedor'])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! form::label('fecha', 'Fecha: ', ['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon"><a href="#"><i class="linecons-calendar"></i></a></div>
                            {!! form::input('date','fecha', null , ['class' => 'form-control datepicker', 'data-format'=>'yyyy-mm-dd'])!!}

                        </div>

                    </div>
                </div>
                <div class="form-group">
                    {!! form::label('concepto', 'Concepto: ', ['class'=>'control-label col-sm-2 '])!!}
                    <div class="col-sm-10">
                        {!! form::text('concepto', null, ['class' => 'form-control','placeholder'=>'breve descripcion del concepto'])!!}

                    </div>
                </div>

                <div class="form-inline">
                    {!! form::label('total', 'Total: ', ['class'=>'control-label col-sm-2'])!!}
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {!! form::text('total', null, ['class' => 'form-control'])!!}
                            <span class="input-group-addon">.00</span>
                        </div>


                    </div>

                </div>

                <div class="form-group">
                    {!! form::label('forma_pago_id', 'Forma de Pago: ', ['class'=>'control-label col-sm-2 '])!!}
                    <div class="col-sm-4">
                        {!! form::select('forma_pago_id', $pago, null, ['class' => 'form-control'])!!}


                    </div>
                </div>
                <div class="form-group-separator"></div>
                <div class="form-group col-sm-4">
                    {!! Form::submit('Guardar', ['class' => 'col-sm-offset-7 btn btn-secondary form-control'])!!}
                </div>
            </div>


        </div>
    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    <script src="http://themes.laborator.co/xenon/assets/js/datepicker/bootstrap-datepicker.js"
            id="script-resource-9"></script>

@stop

