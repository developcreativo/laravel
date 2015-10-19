<!-- Modal clientes-->
<div class="modal fade" id="clientes-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Clientes</h4>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Buscar cliente..."
                           aria-describedby="sizing-addon1" id="buscar_cliente">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
                </div>

                <table class="table table-striped table-condensed table-bordered js-dataTable-full" role="grid"
                       id='clientes'
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th hidden>COD</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td hidden>{{$cliente->id}}</td>
                            <td>{{$cliente->documento}}</td>
                            <td>{{ str_limit($cliente->cliente, $limit = 20, $end = '...')}} </td>
                            <td>{{ $cliente->email}} </td>
                            <td>
                                <a class='btn btn-success btn-xs' href='#' role='button'
                                   onclick='AgCliente("{{$cliente->id}}","{{$cliente->cliente}}")'
                                   data-dismiss="modal">
                                    <span class='fa fa-check-square-o' aria-hidden='true'></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" data-toggle="modal"
                            data-target="#AGCLIENTE">Agregar Nuevo Cliente
                    </button>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-warning btn-block" onclick="ClienteRapido()"
                            data-dismiss="modal">Cliente Rapido
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('app.clientes.formulario_clientes')