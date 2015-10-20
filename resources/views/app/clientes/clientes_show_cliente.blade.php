<div class='block block-themed'>
    <div class="block-content">

        {!! Form::model($cliente, ['action'=>['ClientesController@update',$cliente->id],'method' => 'patch']) !!}
        {{-- formulario de cliente sirve para editar y crear --}}
                <!--- Codigo Field --->
        <div class="row push-20">
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="{{url('img/image.png')}}" width="100%">
                </div>

            </div>
            <div class="col-sm-9">
                <!-- codigo y nombre del cliente -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nombre:</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {!! Form::text('cliente',null, ['class' => 'form-control','style'=>'text-transform:
                                capitalize;','disabled']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nit o Cédula:</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                {!! Form::text('documento', null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- marcas y categorias -->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Email:</label>

                        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                            {!! Form::email('email', null, ['class'=>'form-control', 'disabled']) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Teléfono:</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            {!! Form::text('telefono',null,['class'=>'form-control', 'disabled'])!!}
                        </div>
                    </div>

                </div>
                <!-- precio de venta, compra y rentabilidad -->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Departamento:</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="si si-globe"></i></span>
                            {!! form::select('departamento', $departamentos, $cliente->ciudad->departamentos->id,
                             ['class' => 'form-control departamento', 'disabled'])!!}
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Ciudad:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="si si-globe"></i></span>
                            {!! form::select('ciudad_id', $ciudades, null, ['class' => 'form-control ciudad',
                            'data-ciudad'=> $ciudadesJSON , 'disabled'])!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- description -->
        <div class="form-group row">
            {!! Form::label('Nombre', 'Dirección:',['class' => 'col-sm-2 text-right']) !!}

            <div class="col-sm-10">{!! Form::textarea('direccion', null, ['class' =>'form-control','rows'=>'3', 'disabled']) !!}
            </div>
        </div>

        <div class="form-group row text-center">
            <a class="btn btn-primary btn-lg editar" type="button" onclick="editar()">Editar</a>
            {!! Form::submit('Enviar', ['class' => 'btn btn-lg btn-primary enviar']) !!}
            <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal-delete-cliente">
                Eliminar
            </button>
        </div>
        {!! Form::close() !!}

    </div>
</div>
<script>
    $('.enviar').hide();
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
    function editar(){
        $('.form-control').removeAttr("disabled");
        $('.editar').hide();
        $('.enviar').show();

    }

</script>