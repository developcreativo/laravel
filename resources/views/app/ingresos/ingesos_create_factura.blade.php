<div class="col-sm-6">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar venta..."
               aria-describedby="sizing-addon1" id="buscar_venta">
                <span class="input-group-addon" id="sizing-addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
    </div>
    <table class="table table-condensed table-striped table-vcenter js-dataTable-full" id="ventas">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Cliente</th>
            <th class="text-center">Deuda</th>
            <th class="text-center">action</th>
        </tr>
        </thead>
        <tbody id="tabla-todos">
        @foreach($ventas as $venta)

            <tr>
                <td class="font-w600 text-center">{{$venta->factura}}</td>
                <td class="font-w600 text-center">{{$venta->clientes->cliente}} </td>
                <td class="text-center font-w600 text-success">${{ number_format($venta->venta - $venta->pagado) }}</td>
                <td class="text-center">
                    <a class='btn btn-success btn-xs' href='#'
                       onclick='agregaritems("{{$venta->id}}","{{$venta->venta - $venta->pagado}}","{{$venta->clientes->cliente}}","{{$venta->factura}}")'
                       data-toggle="tooltip" data-original-title="Agregar">
                        <span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="col-sm-6 border table-responsive" >
    <table class="table table-condensed table-striped table-vcenter">
        <thead>
        <tr>
            <th class="text-center">Factura</th>
            <th class="text-center">Cliente</th>
            <th class="text-center">Valor</th>
        </tr>
        </thead>
        <tbody id="tabla-pagar">

        </tbody>
    </table>
</div>
<div class="col-sm-6 totales push-20-t">
    <div class="btn btn-lg btn-primary btn-block text-center" onclick="abrir_pagos_factura()">
        <span class="total"><small>TOTAL: </small>$</span>
        <input class="total" id="total" readonly="readonly" name="total" type="text">
    </div>
</div>
