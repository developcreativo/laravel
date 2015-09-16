<div class="panel panel-default">
    <div class="panel-heading">Equipo de trabajo</div>
    <div class="panel-body">
        <p class="col-sm-9">Puedes agregar, editar o eliminar a cualquier usuario de tu empresa</p>

        <div class="col-sm-3"><a class="btn btn-blue pull-right" data-toggle="modal" data-target="#usuario">Agregar
                Usuario</a></div>

    </div>

    <div class="table-responsive" style="margin-top: 10px">
        <table class="table table-hover" id="users-list">
            {{--*/ $i = 0 /*--}}
            @foreach($users as $user)

                <tr data-id="{{$user->id}}">
                    <td>
                        <img src="http://localhost/img/{{$user->image}}" class="img-circle img-corona"
                             width="68" height="62"
                             alt="usuario">
                    </td>
                    <td>
                        <div class="information">
                            <div class="info-group"><p style="font-size: 24px; text-transform: uppercase">
                                    <strong>{{$user->name}}</strong></p></div>
                            <div class="info-group smaller-text">{{$user->email}}</div>
                        </div>
                    </td>
                    <td style="vertical-align: middle">
                        <div class="additional-information" align="middle">
                            <div class="info-group">
                                <div class="text-center"><strong>Role</strong><br><span class="smaller-text">Administrador</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: middle">
                        <div class="additional-information" align="middle">
                            <div class="info-group">
                                <div class="text-center"><strong>Activo</strong><br>

                                    <div class="form-block"><input type="checkbox" checked=""
                                                                   class="iswitch-lg iswitch-secondary"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <a class='btn btn-warning' href='#' role='button' data-toggle="modal" data-target="#editar_usuario" data-id="{{$i}}">
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <a class='btn btn-danger' href='#' role='button' data-id='{{$i}}'>
                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                        </a>
                    </td>

                </tr>
                <?php $i++ ?>
            @endforeach
        </table>
    </div>
</div>
<!-- formulario de usuario para agregar y editar -->
@include('app.configuracion.agregar_editar_usuario')