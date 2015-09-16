@extends('layouts.master')

@section('title')Productos
@stop
@section('style')


@stop

@section('content')
    <!-- //aca ingresa la informacion angular js-->
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Buscar productos..."
                       aria-describedby="sizing-addon1" id="buscar">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <a href="{{ URL::to('productos/create')}}" class="btn btn-lg btn-primary btn-block">
                <i class="fa fa-plus"></i><span>  Nuevo producto</span>
            </a>
        </div>
    </div>
    <br>
    <div class='block block-themed'>
        <div class="block-header bg-primary-light">
            <h3 class="block-title">Tabla de @yield('title')</h3>
        </div>
        <div class="block-content table-responsive">
            <table class="table table-condensed js-dataTable-full" id="productos">
                <thead>
                <tr>
                    <th hidden>id</th>
                    <th>SKU</th>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Venta</th>
                    <th>action</th>
                </tr>
                </thead>

                <tbody id="tabla-todos">
                @foreach($productos as $producto)

                    <tr>
                        <td hidden>{{$producto->id}}</td>
                        <td>{{$producto->SKU}} </td>
                        <td>{!!HTML::link('productos/'.$producto->id,$producto->producto)!!}</td>
                        <td>{{$producto->categorias->categoria}} </td>
                        <td>{{$producto->marcas->marca}} </td>
                        <td>${{number_format($producto->venta)}}</td>

                        <td>
                            <a class='btn btn-warning btn-xs' href='productos/{{$producto->id}}/edit'
                               role='button'>
                                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                            </a>
                            <a class='btn btn-info btn-xs' href='#' role='button' data-id="{{$producto->id}}">
                                <span class='glyphicon glyphicon-align-justify' aria-hidden='true'></span>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>


@stop

@section('scripts')
    <script>

    </script>
    {!! HTML::script('assets/js/plugins/datatables/jquery.dataTables.min.js')!!}
    {!! HTML::script('assets/js/pages/base_tables_datatables.js')!!}
@stop