

@extends('layouts.master')

@section('title')remision
@stop
@section('style')

@stop

@section('content')
    <!-- //aca ingresa la informacion angular js-->

    <div>

        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="{{ URL::to('ventas/create')}}">
                    <i class="fa-check"></i><span> Nueva venta </span></a>
            </li>



        </ul>
    </div>
    <br>
    <div class="row"></div>
    <div class='panel panel-color panel-success'>
        <div class="panel-heading">
            <h3 class="panel-title">Tabla de remision</h3>

        </div>
        <div class="panel-body">
            <script type="text/javascript">
                jQuery(document).ready(function($)
                {
                    $("#remision").dataTable({dom: "<'row'<'col-sm-5'l><'col-sm-7'Tf>r>"+
                    "t"+
                    "<'row'<'col-xs-6'i><'col-xs-6'p>>", order:[['0','desc']],
                        tableTools: {
                            sSwfPath: "http://localhost/assets/js/datatables/tabletools/copy_csv_xls_pdf.swf"}
                    });
                });
            </script>

            <table class="table table-striped table-bordered dataTable"  role="grid" id='remision' cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="6%" hidden>ID</th>
                    <th>Factura</th>
                    <th width="35%">Cliente</th>
                    <th>Tienda</th>
                    <th width="11%">fecha</th>
                    <th width="9%">Pago</th>
                    <th width="16%">action</th>
                </tr>
                </thead>

                <tbody id="tabla-todos">
                @foreach($facturas as $factura)

                    <tr>
                        <td hidden>{{$factura->id}}</td>
                        <td>{{$factura->remision->id}} </td>
                        <td>{{$factura->remision->clientes->cliente}} </td>
                        <td>{{$factura->remision->tiendas->bodega}} </td>
                        <td>{{str_limit($factura->remision->created_at, $limit = 10, $end = '')}} </td>
                        <td>{{$factura->remision->id}} </td>
                        <td>
                            <a class='btn btn-warning btn-sm' href='remision/{{$factura->id}}/edit' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                            <a class='btn btn-danger btn-sm' href='remision/delete/{{$factura->id}}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            <a class='btn btn-info btn-sm' href='remision/{{$factura->id}}/print' role='button'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>




@stop

@section('scripts')

    @include('layouts/datatables')
@stop