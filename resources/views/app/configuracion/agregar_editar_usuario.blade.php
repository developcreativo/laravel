<!-- Modal -->
<div class="modal fade" id="usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
            </div>
            <div class="modal-body">
                <!-- agregar formulario para creacion de usuario -->
                {!! Form::open(['files'=>'true', 'action' => 'UserController@store','class'
                =>'form-horizontal','id'=>'form_user']) !!}
                @include('app/configuracion/formulario_usuario')
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="agregar_usuario" data-dismiss="modal">Agregar
                    Usuario
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <!-- agregar formulario para creacion de usuario -->
                {!! Form::model($users->find(11),['files'=>'true', 'action' => 'UserController@store','class'
                =>'form-horizontal','id'=>'form_user']) !!}
                @include('app/configuracion/formulario_usuario')
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="agregar_usuario" data-dismiss="modal">Agregar
                    Usuario
                </button>
            </div>
        </div>
    </div>
</div>
srop