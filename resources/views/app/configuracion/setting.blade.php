<?php

if (Auth::user()->company_id <> 0):
    $method = 'PATCH';
    $action = ['ConfiguracionController@update', Auth::user()->company->id];
else:
    $method = 'POST';
    $action = 'ConfiguracionController@store';
endif;

?>

<div class="col-xs-9">
    {!! Form::model(Auth::user()->company,['method'=>$method,'enctype'=>'multipart/form-data', 'action' => $action,'class' =>'form-horizontal','id'=>'form_company']) !!}
    <div class="form-group">
        <!--- company Field --->
        <label for="company" class="control-label col-xs-3">Empresa:</label>

        <div class="col-xs-9">
            {!! Form::text('company', null, ['class' => 'form-control','placeholder'=>'Nombre de la empresa']) !!}
        </div>
    </div>
    <div class="form-group">
        <!--- company Field --->
        <label for="nit" class="control-label col-xs-3">NIT de la empresa:</label>

        <div class="col-xs-9">
            {!! Form::text('nit', null, ['class' => 'form-control','placeholder'=>'NIT de la empresa']) !!}
        </div>
    </div>
    <div class="form-group">
        <!--- company Field --->
        <label class="control-label col-xs-3">Telefono:</label>

        <div class="col-xs-9">
            {!! Form::text('telefono', null, ['class' => 'form-control','placeholder'=>'Teléfono de la empresa'])
            !!}
        </div>
    </div>
    <div class="form-group">
        <!--- company Field --->
        <label class="control-label col-xs-3">Dirección:</label>

        <div class="col-xs-9">
            {!! Form::text('direccion', null, ['class' => 'form-control','placeholder'=>'Dirección de la empresa'])
            !!}
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('logo', 'Logo:',['class' => 'col-xs-3 text-right']) !!}
        <div class="col-xs-9">
            <div class="input-group">
                {!! Form::file('img', null) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-9">
            <div id="enviar" class="btn btn-primary btn-lg">Enviar</div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
<div class="logo well col-sm-3" style="height: 200px"></div>