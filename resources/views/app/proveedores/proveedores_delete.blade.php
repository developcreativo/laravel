<!-- modal delete -->
<div class="modal fade" id="modal-delete-proveedor" tabindex="-1" role="dialog" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-dialog-popout modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-danger">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Advertencia</h3>
                </div>
                <div class="block-content">
                    <p>¿Seguro desea eliminar este proveedor?, perderá toda la información relacionada con el mismo</p>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::open(['data-id'=>'#','id'=>'formulario_delete_proveedor','method'=>'delete','action'=>['ProveedoresController@destroy',':ID']]) !!}
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-sm btn-success" id="eliminar_proveedor" data-dismiss="modal"><i
                            class="fa fa-check"></i> Entiendo
                </button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- end modal delete -->
<script>
    function borrar(id) {
        var form = $('#formulario_delete_proveedor');
        form.attr('data-id', id);
    }
    $('#eliminar_proveedor').click(function (e) {
        e.preventDefault();
        var form = $('#formulario_delete_proveedor');
        var id = form.attr('data-id');
        var url = form.attr('action').replace(':ID', id);
        var data = form.serialize();
        $.post(url, data, function (response) {
            console.log(response);
            $('#proveedor_' + response.id).fadeOut();
            $.notify({
                title: "<strong>Respuesta:</strong> ",
                message: response.mensaje,
                icon: 'fa fa-check'
            }, {
                type: 'success'
            });
        }).fail(function (response) {
            $('#proveedor_' + response.id).show();
            $.notify({
                title: "<strong>Respuesta:</strong> ",
                message: 'Lo siento no se pudo eliminar el proveedor',
                icon: 'fa fa-times'
            }, {
                type: 'danger'
            });
        });
    });
</script>