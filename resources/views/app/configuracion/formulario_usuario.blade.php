<div class="form-group">
    <!--- company Field --->
    <label for="company" class="control-label col-xs-3">Nombre:</label>

    <div class="col-xs-9">
        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nombre del usuario']) !!}
    </div>
</div>
<div class="form-group">
    <!--- company Field --->
    <label class="control-label col-xs-3">Email:</label>

    <div class="col-xs-9">
        {!! Form::email('email', null, ['class' => 'form-control','placeholder'=>'email del usuario'])
        !!}
    </div>
</div>
<div class="form-group">
    <!--- company Field --->
    <label class="control-label col-xs-3">Contraseña:</label>

    <div class="col-xs-9">
        {!! Form::text('password', null, ['class' => 'form-control','placeholder'=>'Contraseña'])
        !!}
    </div>
</div>
<div class="form-group">
    <!--- company Field --->
    <label for="nit" class="control-label col-xs-3">Rol del usuario:</label>

    <div class="col-xs-9">
        {!! Form::select('rol_id', array('0' => 'Adiministrador', '1' => 'Vendedor'), '1',['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:',['class' => 'col-xs-3 text-right']) !!}
    <div class="col-xs-9">
        <div class="input-group">
            {!! Form::file('image',null) !!}
        </div>
    </div>
</div>