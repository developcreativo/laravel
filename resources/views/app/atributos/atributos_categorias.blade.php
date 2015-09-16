<!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-9 col-xs-12">
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Buscar marca..."
                   aria-describedby="sizing-addon1" id="buscar_categoria">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#Modal_Categorias">
            <i class="fa fa-plus"></i><span>  Nueva Categoría</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de Categorías</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table js-dataTable-full table-striped table-condensed" id="categorias">
            <thead>
            <tr>
                <th>Id</th>
                <th>Categoría</th>
                <th>Sub-categoría</th>
                <th>Productos</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categorias as $categoria)

                <tr>
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->categoria}}</td>
                    <td><?php $n = $categoria->level;
                        $whole = floor($n);
                        $fraction = $n - $whole;?>
                        @if( $fraction > 0 )
                           <span class="badge badge-danger">Si</span>
                        @else
                            <span class="badge badge-default">No</span>
                        @endif
                    </td>
                    <td><span class="badge badge-success">{{count($categoria->productos)}}</span></td>
                    <td>
                        <a class='btn btn-warning btn-xs' href='marcas/{{$categoria->id}}/edit' role='button'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <a class='btn btn-info btn-xs' href='#' role='button' data-id="{{$categoria->id}}">
                            <span class='glyphicon glyphicon-align-justify' aria-hidden='true'></span>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>
@include('app.categorias.formulario_categoria')