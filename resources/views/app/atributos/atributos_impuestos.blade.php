<!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-9 col-xs-12">
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Buscar impuesto..."
                   aria-describedby="sizing-addon1" id="buscar_impuesto">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#Modal_Impuestos">
            <i class="fa fa-plus"></i><span>  Nuevo Impuesto</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de Impuestos</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table js-dataTable-full table-striped table-condensed" id="impuestos">
            <thead>
            <tr>
                <th>id</th>
                <th width="600">Impuesto</th>
                <th>Valor</th>
                <th>action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($impuestos as $impuesto)

                <tr id="impuesto_{{$impuesto->id}}">
                    <td>{{$impuesto->id}}</td>
                    <td>{{$impuesto->impuesto}}</td>
                    <td><span class="badge badge-success">{{$impuesto->valor}}</span></td>
                    <td>
                        <a class='btn btn-warning btn-xs' href='marcas/{{$impuesto->id}}/edit' data-toggle="tooltip"
                           data-original-title="Editar">
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <a class='btn btn-danger btn-xs' href='#' data-toggle="modal"  data-target="#modal-delete-impuesto"
                           onclick="borrar({{$impuesto->id}})">
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
@include('app.impuestos.formulario_impuestos')
@include('app.impuestos.impuestos_delete')