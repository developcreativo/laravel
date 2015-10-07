<div class='block block-themed'>

    <div class="block-content table-responsive">
        <table class="table table-striped table-vcenter">
            <thead>
            <tr>
                <th hidden>id</th>
                <th>Producto</th>
                <th>atributos</th>
                <th>action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($productos as $producto)

                <tr>
                    <td hidden>{{$producto->id}}</td>
                    <td><strong>{{$producto->producto}}</strong></td>
                    <td>@if($producto->variable_1 <> 0)
                            <span class="label label-primary">{{$producto->variable1->variable}}</span>
                        @else
                            <span class="label label-default">No tiene</span>
                        @endif
                        @if($producto->variable_2 <> 0)
                            <span class="label label-success">{{$producto->variable2->variable}}</span>
                        @endif


                    </td>
                    <td>
                        <a class='btn btn-warning btn-xs' href='productos/variables/{{$producto->id}}/edit'
                           role='button'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <button class='btn btn-danger btn-xs' data-toggle="modal" data-target="#modal-delete"
                                onclick="borrar({{$producto->id}})">
                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                        </button>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>
<!-- modal delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                    <p>¿Está seguro de querer eliminar este producto? perderá toda la informacion relacionada con el así
                        como sus ventas, reportes y estadisticas</p>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id'=>'formulario_delete_variable','method'=>'delete','action'=>['ProductosVariablesController@destroy',':PRODUCTO_ID']]) !!}
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> Entiendo</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- end modal delete -->
<!-- modal edit -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                    <p>¿Está seguro de querer eliminar este producto? perderá toda la informacion relacionada con el así
                        como sus ventas, reportes y estadisticas</p>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id'=>'formulario_delete','method'=>'delete','action'=>['ProductosVariablesController@destroy',':PRODUCTO_ID']]) !!}
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> Entiendo</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<!-- end modal edit -->
<script>
    function borrar(id) {
        var form = $('#formulario_delete_variable');
        var action = form.attr('action').replace(':PRODUCTO_ID',id);
        form.attr('action',action);
    }
</script>