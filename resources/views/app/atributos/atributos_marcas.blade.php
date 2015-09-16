<!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-9 col-xs-12">
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Buscar marca..."
                   aria-describedby="sizing-addon1" id="buscar_marca">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#Modal_Marcas">
            <i class="fa fa-plus"></i><span>  Nueva marca</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de marcas</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table js-dataTable-full table-striped table-condensed" id="marcas">
            <thead>
            <tr>
                <th>id</th>
                <th width="60%">Marca</th>
                <th>productos</th>
                <th>action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($marcas as $marca)

                <tr>
                    <td>{{$marca->id}}</td>
                    <td>{{$marca->marca}}</td>
                    <td><span class="badge badge-success">{{count($marca->productos)}}</span></td>
                    <td>
                        <a class='btn btn-warning btn-xs' href='marcas/{{$marca->id}}/edit' role='button'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <a class='btn btn-info btn-xs' href='#' role='button' data-id="{{$marca->id}}">
                            <span class='glyphicon glyphicon-align-justify' aria-hidden='true'></span>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>
@include('app.marcas.formulario_marca')