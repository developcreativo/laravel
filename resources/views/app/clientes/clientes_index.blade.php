@extends('layouts.master')

@section('title')Clientes
@stop

@section('description')
@stop

@section('style')
@stop

@section('breadcrumb')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Buscar cliente..."
                       aria-describedby="sizing-addon1" id="buscar_cliente">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal"  data-target="#AGCLIENTE">
                <i class="fa fa-plus"></i><span>  Nuevo Cliente</span>
            </a>
        </div>
    </div>
    <br>
    <div class='block block-themed'>
        <div class="block-header bg-primary-light">
            <h3 class="block-title">Tabla de Clientes</h3>
        </div>
        <div class="block-content table-responsive">
            <table class="table js-dataTable-full table-striped table-condensed" id="clientes">
                <thead>
                <tr>
                    <th>id</th>
                    <th>cliente</th>
                    <th>Documento</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($clientes as $cliente)

                    <tr id="cliente_{{$cliente->id}}">
                        <td>{{$cliente->id}}</td>
                        <td class="font-w600"><a href="clientes/{{ $cliente->id }}">{{$cliente->cliente}}</a></td>
                        <td>{{$cliente->documento}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>
                            <a class='btn btn-warning btn-xs' href='clientes/{{$cliente->id}}/edit' role='button'>
                                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                            </a>
                            <a class='btn btn-danger btn-xs' href='#' data-toggle="modal"  data-target="#modal-delete-cliente"
                               onclick="borrar({{$cliente->id}})">
                            <span class='glyphicon glyphicon-trash' data-toggle="tooltip"
                                  data-original-title='Eliminar' aria-hidden='true'></span>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @include('app.clientes.clientes_delete')
    @include('app.clientes.formulario_clientes')

@stop

@section('scripts')

    <script>
        function AgClienteNuevo() {
            $('#loading').show()
            var form = $('#AgClienteForm');
            var url = form.attr('action');
            var data = form.serialize();
            $.post(url, data, function (response) {
                $('#loading').fadeOut(800);
                $.notify({
                    title: "<strong>Respuesta:</strong> ",
                    message: response.mensaje,
                    icon: 'fa fa-check'
                }, {
                    type: 'success'
                });
                location.reload(true);
            }).fail(function (response) {
                $('#loading').fadeOut(800);
                $.notify({
                    title: "<strong>Respuesta:</strong> ",
                    message: 'Cliente duplicado o vacio',
                    icon: 'fa fa-times'
                }, {
                    type: 'danger'
                });

            });
        }
    </script>
@stop