<div class="form-group">
    <div class="col-xs-3">
        {!! Form::label('Nit', 'NIT/Cedula:') !!}
                <!--- NIT Field --->
        {!! Form::text('nit', null, ['class' => 'form-control','placeholder'=>'Ingrese su NIT...']) !!}

    </div>
    <div class="col-xs-9">
        <!--- proveedor Field --->
        {!! Form::label('proveedor', 'proveedor:') !!}
        {!! Form::text('proveedor', null, ['class' => 'form-control','placeholder'=>'Ingrese su proveedor...']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-xs-6">
        {!! Form::label('contacto', 'contacto:') !!}
        <div class="input-group">
            <!--- contacto Field --->
            {!! Form::text('contacto', null, ['class' => 'form-control','placeholder'=>'Ingrese su contacto']) !!}
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
    </div>
    <div class="col-xs-6">
        {!! Form::label('telefono', 'telefono:') !!}
        <div class="input-group">
            <!--- email Field --->
            {!! Form::text('telefono', null, ['class' => 'form-control','placeholder'=>'Ingrese su telefono']) !!}
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        </div>
    </div>


</div>
<div class="form-group">
    <div class="col-xs-6">
        {!! Form::label('web', 'web:') !!}
        <div class="input-group">
            <!--- contacto Field --->
            {!! Form::text('web', null, ['class' => 'form-control','placeholder'=>'Ingrese su web']) !!}
            <span class="input-group-addon">.example.com</span>
        </div>
    </div>
    <div class="col-xs-6">
        {!! Form::label('email', 'email:') !!}
        <div class="input-group">
            <!--- email Field --->
            {!! Form::email('email', null, ['class' => 'form-control','placeholder'=>'Ingrese su email']) !!}
            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        </div>
    </div>
</div>



