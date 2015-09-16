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
<!-- Modal formulario AGcliente-->
<div class="modal fade" id="AGCLIENTE" aria-hidden="true" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar Cliente</h4></div>
            <div class="modal-body">
                {!! Form::open(['id'=>'AgClienteForm']) !!}
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
                            {!! Form::label('telefono', 'Telefono:') !!}
                            {!! Form::text('telefono', null, ['class' => 'form-control','placeholder'=>'000-000'])
                            !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!--- Correo Field --->
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', null, ['placeholder'=>'correo electronico','class' =>
                            'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!--- Departamento Field --->
                        <div class="form-group">
                            {!! Form::label('departamento', 'Departamento:') !!}
                            {!! Form::text('departamento', null, ['class' =>
                            'form-control','placeholder'=>'Departamento']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--- Ciudad Field --->
                        <div class="form-group">
                            {!! Form::label('ciudad', 'Ciudad:') !!}
                            {!! Form::text('ciudad_id', null, ['class' => 'form-control','placeholder'=>'Ciudad'])
                            !!}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="AgClienteNuevo()">Guardar</button>
            </div>
        </div>
    </div>
</div>