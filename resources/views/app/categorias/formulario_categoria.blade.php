<!-- Modal categorias -->
<div class="modal fade" id="Modal_Categorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 30%">
        {!! Form::open(['action' => 'CategoriasController@store','class'=>'form-horizontal','id'=>'form_categorias'])
        !!}
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b push-20">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Crear Categoría</h3>
                </div>
            </div>

            <div class="block-content">
                <div class="col-sm-12" id="categoria_padre">
                    <div class="form-group ">
                        <!--- categoria Field --->
                        <label>Categoria padre:</label>
                        {!! Form::select('level', $categorias_padre, null, ['class' =>
                        'form-control','placeholder'=>'Seleccione','id'=>'lista_categorias_padre'])
                        !!}
                    </div>
                </div>
                <div class="col-sm-8">

                    <div class="form-group">
                        <!--- categoria Field --->
                        {!! Form::text('categoria', null, ['class' => 'form-control','placeholder'=>'nombre...']) !!}
                    </div>
                </div>
                <div class="col-sm-4 text-center">

                    <div class="form-group">
                        <!--- categoria Field --->
                        <label class="css-input switch switch-success">
                            {!! Form::checkbox('sub_categoria', '1' ,
                            false,['class'=>'form-control',
                            'data-toggle'=>'tooltip','data-placement'=>'top',
                            'data-original-title'=>'¿Es Sub-categoría?','onclick'=>'mostrar_categoria();',
                            'id'=>'check_categoria']) !!}<span></span> ¿Si?
                        </label>

                    </div>
                </div>
                <div class="row"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('guardar', ['class' => 'btn btn-success','id' => 'enviar_categoria',
                'data-dismiss'=>'modal']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    function mostrar_categoria() {
        if ($('#check_categoria').is(":checked")) {
            $('#categoria_padre').show()
        } else {
            $('#categoria_padre').hide()
        }
    }
    $('#categoria_padre').hide()
    $('#enviar_categoria').click(function (e) {
        $('#loading').show()
        e.preventDefault();
        var form = $('#form_categorias');
        var url = form.attr('action');
        var data = form.serialize();
        $.post(url, data, function (response) {
            if (response.refresh == 'si') {
                location.reload(true);
            } else {
                $('#loading').fadeOut(800);
                $.notify({
                    title: "<strong>Respuesta:</strong> ",
                    message: response.mensaje,
                    icon: 'fa fa-check'
                }, {
                    type: 'success'
                });
                $('#list_categorias').empty().html(response.categoria);
                $('#lista_categorias_padre').empty().html(response.categorias_padre);
            }
        }).fail(function (response) {
            $('#loading').fadeOut(800);
            $.notify({
                title: "<strong>Respuesta:</strong> ",
                message: 'Lo siento no se pudo crear la categoria',
                icon: 'fa fa-times'},{
                type: 'danger'
            });
        });
    });

</script>