

@extends('layouts.master')

@section('title')Egresos
@stop
@section('style')

@stop

@section('content')
    <!-- //aca ingresa la informacion angular js-->

    <div>

        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="{{ URL::to('egresos/create')}}">
                    <i class="fa-check"></i><span> Nuevo Egreso </span></a>
            </li>
        </ul>
    </div>
    <br>
    <div class="row"></div>
    <div class='panel panel-color panel-success'>
        <div class="panel-heading">
            <h3 class="panel-title">Tabla de Egresos</h3>
            <div class="panel-options">
                <a href="#"><i class="linecons-cog"></i> </a>
                <a href="#" data-toggle="panel"> <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a>
                <a href="#" data-toggle="reload"> <i class="fa-rotate-right"></i> </a>
                <a href="#" data-toggle="remove">×</a>
            </div>
        </div>
        <div class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {
                $("#egresos").dataTable({dom: "<'row'<'col-sm-5'l><'col-sm-7'Tf>r>"+
                "t"+
                "<'row'<'col-xs-6'i><'col-xs-6'p>>", order:[['0','desc']],
                    tableTools: {
                        sSwfPath: "http://localhost/assets/js/datatables/tabletools/copy_csv_xls_pdf.swf"}
                });
            });
        </script>

        <table class="table table-striped table-bordered dataTable"  role="grid" id='egresos' cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="8%">COD</th>
                <th>Proveedor</th>
                <th>concepto</th>
                <th width="12%">fecha</th>
                <th>Pago</th>
                <th>total</th>
                <th width="17%">action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($egresos as $egreso)

                <tr>
                    <td>{{$egreso->id}}</td>
                    <td>{{ str_limit($egreso->proveedor_id, $limit = 20, $end = '...')}} </td>
                    <td>{{ str_limit($egreso->concepto, $limit = 20, $end = '...')}} </td>
                    <td>{{$egreso->fecha}} </td>
                    <td>{{$egreso->forma_pago->forma_pago}} </td>
                    <td>${{$egreso->total}} </td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='egresos/{{$egreso->id}}/edit' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                        <a class='btn btn-danger btn-sm' href='egresos/delete/{{$egreso->id}}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        <a class='btn btn-info btn-sm' href='egresos/{{$egreso->id}}' role='button'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
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