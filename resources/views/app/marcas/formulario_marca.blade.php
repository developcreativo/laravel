<!-- Modal marcas -->
<div class="modal fade" id="Modal_Marcas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        {!! Form::open(['action' => 'MarcasController@store','class'=>'form-horizontal','id'=>'form_marcas']) !!}
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b push-20">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Crear Marca</h3>
                </div>
            </div>

            <div class="block-content">
                <!--- marca Field --->
                {!! Form::text('marca', null, ['class' => 'form-control']) !!}
            </div>
            <div class="modal-footer push-20-t">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('guardar', ['class' => 'btn btn-success','id' => 'enviar_marca', 'data-dismiss'=>'modal']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#enviar_marca').click(function (e) {
            $( '#loading' ).show()
            e.preventDefault();
            var form = $('#form_marcas');
            var url = form.attr('action');
            var data = form.serialize();
            $.post(url, data, function (response) {
                if(response.refresh == 'si'){
                    location.reload(true);

                }else{
                    $('#loading').fadeOut(800);
                    $.notify({
                        title: "<strong>Respuesta:</strong> ",
                        message: response.mensaje,
                        icon: 'fa fa-check'
                    },{
                        type: 'success'
                    });
                    $('#list_marcas').append(response.marca);
                }
            }).fail(function (response) {
                $('#loading').fadeOut(800);
                $.notify({
                    title: "<strong>Respuesta:</strong> ",
                    message: 'Lo siento no se pudo crear la marca',
                    icon: 'fa fa-times'},{
                    type: 'danger'
                });
            });
        });
    });
</script>