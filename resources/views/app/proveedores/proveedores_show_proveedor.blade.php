<div class='block block-themed'>
    <div class="block-content">

        {!! Form::model($proveedor,['method'=>'PATCH','class'=>'form-horizontal push-5-t js-validation-proveedor','action'=>['ProveedoresController@update',$proveedor->id]]) !!}
        @include('app.proveedores.proveedores_formulario')
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4 push-10">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>