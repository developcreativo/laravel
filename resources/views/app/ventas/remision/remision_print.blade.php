@extends('layouts.master')

@section('title')
@stop

@section('description')
@stop

@section('style')
    <style type="text/css">
        .factura {
            width: 10cm;
        }

        .factura p, p + p {
            margin: 0px !important;
        }

        .panel-heading img {
            margin-bottom: 5px;
        }

        .ticket {
            border: solid 1px #bbbbbb;
            border-radius: 5px;
            margin: 3px;
        }

        .factura td, th, .panel-footer p {
            font-size: smaller;
            padding: 0px !important;
        }

        .factura .row {
            font-size: large;

        }

        @media print {
            .text-right {
                float: left;
                padding-left: 16%;
            }
            .panel{
                margin: 0px !important;
                margin-left: 10px;
                padding: 10px !important;
            }

        }

    </style>
@stop

@section('breadcrumb')
@stop

@section('content')

    <div class="panel panel-default center-block factura">
        <div class="panel-heading text-center">
            <img src="/img/logoalizquirdamediano.jpg" class="img-responsive">

            <p><strong>{{$venta->remision->tiendas->tienda}}</strong></p>

            <p><strong>Nit: <span> {{$venta->remision->tiendas->NIT}}</span></strong></p>

            <small>
                <p>Dirección: <span> {{$venta->remision->tiendas->direccion}}</span></p>

                <p>Telefono: <span> {{$venta->remision->tiendas->telefono}}</span></p>

                <p>Fecha: <span>{{$venta->remision->created_at}}</span></p>

                <p>Cliente: <span>{{$venta->remision->clientes->cliente}}</span></p>
            </small>
            <h3 class="ticket"><p>Remision: <span>{{$venta->remision->id}}</span></p></h3>


        </div>
        <div class="panel-body">
            <table class="table">
                <thead>

                <th>Cant</th>
                <th>Producto</th>
                <th>Sabor</th>
                <th>Valor</th>

                </thead>
                <tbody>
                <?php $i = 0; $a = 0?>
                @foreach($venta->remision->remision_detalle as $venta_detalle)
                    <tr>
                        <td>1</td>
                        <td>{{$venta_detalle->productos_sabor->productos->producto}}</td>
                        <td>{{$venta_detalle->productos_sabor->sabores->sabor}}</td>
                        <td>{{$venta_detalle->venta}}</td>
                        <?php $i += $venta_detalle->iva; $a += $venta_detalle->venta;  ?>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-7 text-right">
                    <p>Sub-total:</p>

                    <p>TOTAL:</p>
                </div>
                <div class="col-sm-5 text-right">
                    <p>${{ $a - $i }}</p>

                    <p>${{$a}}</p>
                </div>
            </div>


        </div>
        <div class="panel-footer text-center">
            <p>Vendedor: <span>{{ $venta->remision->user->name }}</span></p>

        </div>
        <h4 class="text-center">Gracias por su compra</h4>

    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            window.print();
            setTimeout(function () {
                window.location.replace("{{URL::to('ventas/create')}}"), 300
            })
        })
    </script>
@stop