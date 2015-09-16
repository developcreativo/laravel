<!-- //aca ingresa la informacion angular js-->
<div class="row">
    <div class="col-sm-9 col-xs-12">
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Buscar atributo..."
                   aria-describedby="sizing-addon1" id="buscar_atributo">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#Modal_Atributos">
            <i class="fa fa-plus"></i><span>  Nuevo Atributo</span>
        </a>
    </div>
</div>
<br>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de Atributos</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table js-dataTable-full table-striped table-condensed" id="atributos">
            <thead>
            <tr>
                <th>Id</th>
                <th>Atributo</th>
                <th>variables</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($atributos as $atributo)

                <tr>
                    <td>{{$atributo->id}}</td>
                    <td>{{$atributo->atributo}}</td>
                    <td>@foreach($atributo->atributos_sub as $variable)
                            <span class="badge badge-success">{{$variable->variable}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a class='btn btn-warning btn-xs' href='marcas/{{$atributo->id}}/edit' role='button'>
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                        </a>
                        <a class='btn btn-info btn-xs' href='#' role='button' data-id="{{$atributo->id}}">
                            <span class='glyphicon glyphicon-align-justify' aria-hidden='true'></span>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>
@include('app.atributos.formulario_atributo')