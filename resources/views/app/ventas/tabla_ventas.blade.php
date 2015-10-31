<table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="ventas">
    <thead>
    <tr>
        <th class="text-center">Factura</th>
        <th class="text-center">Cliente</th>
        <th class="text-center">Tienda</th>
        <th class="text-center">fecha</th>
        <th class="text-center">Estado</th>
        <th class="text-center">Valor</th>
        <th class="text-center">action</th>
    </tr>
    </thead>
    <tbody id="tabla-todos">
    @foreach($ventas as $venta)

        <tr>
            <td class="font-w600 text-center"><a href='{{ url('ventas/'.$venta->id) }}'>{{$venta->factura}}</a></td>
            <td class="font-w600 text-center">{{$venta->clientes->cliente}} </td>
            <td class="text-center">{{$venta->tiendas->tienda}} </td>
            <td class="text-center">{{str_limit($venta->created_at, $limit = 10, $end = '')}} </td>
            <td class="text-center">@if($venta->venta == $venta->pagado)<span class="label label-success">Pagado</span>
                @else<span class="label label-danger">Pendiente</span>
                @endif
            </td>
            <td class="text-center font-w600 text-success">${{ number_format($venta->venta) }}</td>
            <td class="text-center">
                <a class='btn btn-warning btn-xs' href='{{ url('ventas/'.$venta->id.'/edit') }}' data-toggle="tooltip"
                   data-original-title="Editar"><span
                            class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                <a class='btn btn-danger btn-xs' href='{{ url('ventas/delete/'.$venta->id) }}' data-toggle="tooltip"
                   data-original-title="Eliminar"><span
                            class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                <a class='btn btn-default btn-xs' href='{{ url('ventas/print/'.$venta->id) }}' data-toggle="tooltip"
                   data-original-title="Imprimir"><span
                            class='glyphicon glyphicon-print' aria-hidden='true'></span></a>
                <a class='btn btn-info btn-xs'
                   href='@if(isset($venta->factura_venta)){{url('ventas/pos/'.$venta->factura_venta->id)}}@else{{ url('ventas/pos/'.$venta->factura_remision->id)}}@endif'
                   data-toggle="tooltip" data-original-title="Imprimir POS"><span
                            class='si si-energy' aria-hidden='true'></span></a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>