<!-- Modal formulario AGcliente-->
<div class="modal fade" id="AGCLIENTE" aria-hidden="true" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Agregar Cliente</h3>
                </div>
                <div class="block-content">
                    {!! Form::open(['action'=>'ClientesController@store','id'=>'AgClienteForm']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <!--- Cliente Field --->
                            <div class="form-group">
                                {!! Form::label('cliente', 'Cliente:') !!}
                                {!! Form::text('cliente', null, ['class' => 'form-control','placeholder'=>'Nombre']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--- Telefono Field --->
                            <div class="form-group">
                                {!! Form::label('documento', 'NIT o cedula:') !!}
                                {!! Form::text('documento', null, ['class' => 'form-control','placeholder'=>'Nit o Cedula'])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--- Correo Field --->
                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::text('email', null, ['placeholder'=>'correo electronico','class' =>
                                'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--- Telefono Field --->
                            <div class="form-group">
                                {!! Form::label('telefono', 'Telefono:') !!}
                                {!! Form::text('telefono', null, ['class' => 'form-control','placeholder'=>'000-000-000'])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!--- Departamento Field --->
                            <div class="form-group">
                                {!! Form::label('departamento', 'Departamento:') !!}
                                {!! form::select('departamento', $departamentos, null, ['class' => 'form-control departamento'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--- Ciudad Field --->
                            <div class="form-group">
                                {!! Form::label('ciudad', 'Ciudad:') !!}
                                <select name="ciudad_id" class="form-control ciudad" data-ciudad="{{ $ciudades }}"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('direccion', 'Dirección:') !!}
                            {!! Form::textarea('direccion', null, ['placeholder'=>'datos de dirección','class' =>
                            'form-control','rows'=>'3']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="AgClienteNuevo()">Crear</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.departamento').change(function () {
        id = $('.departamento').val()
        var data = $('.ciudad').data('ciudad')
        var successContent = '';
        for (datos in data) {
            if (data[datos].departamento_id == id) {
                successContent += '<option value="' + data[datos].id + '">' + data[datos].ciudad + '</option>'
            }
        }
        $('.ciudad').html(successContent);

    });
</script>