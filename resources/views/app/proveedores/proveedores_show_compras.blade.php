<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Compras</h3>
    </div>
    <div class="block-content table-responsive">
        <table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="compras">
            <thead>
            <tr>
                <th hidden>id</th>
                <th class="text-center">Factura</th>
                <th class="text-center">valor</th>
                <th class="text-center">Vence</th>
                <th class="hidden-xs text-center">Pagado</th>
                <th class="hidden-sm hidden-xs text-center">Remisión</th>
                <th class="hidden-xs text-center">Bodega</th>
                <th class="text-center">Estado</th>
                <th class="text-center">action</th>
            </tr>
            </thead>

            <tbody id="tabla-todos">
            @foreach($proveedor->compras as $compra)
                <tr>
                    <td hidden>{{$compra->id}}</td>
                    <td class="text-center"><a href='{{ url("compras/".$compra->id) }}'>{{$compra->factura}}</a></td>
                    <td class="text-center font-w600 text-success">${{number_format($compra->valor_total)}} </td>
                    <td class="text-center">{{$compra->fecha_vencimiento}} </td>
                    <td class="hidden-xs text-center ">${{number_format($compra->pagado)}} </td>
                    <td class="hidden-sm hidden-xs text-center">@if($compra->remision == 1) SI @else NO @endif</td>
                    <td class="hidden-xs text-center">{{$compra->tienda->tienda}} </td>
                    <td class="text-center">
                        @if($compra->pagado < $compra->valor_total)
                            @if(strtotime($compra->fecha_vencimiento) < time()) <span class="label label-danger">Vencida</span>
                            @else <span class="label label-warning">Pendiente</span>
                            @endif
                        @else <span class="label label-success">Pagada</span> @endif
                    </td>
                    <td class="text-center">
                        <a class='btn btn-warning btn-xs' href='{{ url("compras/".$compra->id) }}/edit' data-toggle="tooltip"
                           data-original-title="Editar">
                            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                        <a class='btn btn-danger btn-xs' href='{{ url("compras/".$compra->id) }}/delete' data-toggle="tooltip"
                           data-original-title="Eliminar">
                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        <a class='btn btn-info btn-xs' href='{{ url("compras/".$compra->id) }}' data-toggle="tooltip"
                           data-original-title="Imprimir">
                            <span class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
</div>