/**
 * Created by userpc on 08/04/2015.
 */
$(document).ready(function () {
    App.layout('sidebar_mini_on');
    buscar();
    $('.categoria').hide();
    $('.buscador').hide();
    ClienteRapido();
    $('#descuento').keyup(subtotal);

});
$('#buscar').keyup(buscar);
var i = 0
var j = 0
$('#pagos').on('shown.bs.modal', function () {
    valor = $('#total').val()
    $('#total-pago').html('0')
    $('#faltante').html(valor)
    $('#PAGAR').prop('disabled', true);
    $('#tienda_id').val($('#tienda').val())

})
function ClienteRapido() {
    AgCliente("1", "Cliente Preferencial")
}

function AgClienteNuevo() {
    $('#loading').show()
    var form = $('#AgClienteForm');
    var url = form.attr('action');
    var data = form.serialize();
    $.post(url, data, function (response) {
        $('#loading').fadeOut(800);
        $.notify({
            title: "<strong>Respuesta:</strong> ",
            message: 'Cliente agregado exitosamente',
            icon: 'fa fa-check'
        }, {
            type: 'success'
        });
        AgCliente(response.cliente.id, response.cliente.cliente)
    }).fail(function (response) {
        $('#loading').fadeOut(800);
        $.notify({
            title: "<strong>Respuesta:</strong> ",
            message: 'Cliente duplicado o vacio',
            icon: 'fa fa-times'
        }, {
            type: 'danger'
        });

    });
}

function totalpago() {
    var total = $('#total').val()
    var faltante
    var suma = 0
    $('.pagoitem').each(function () {
        suma += parseInt($(this).val())
    })
    faltante = total - suma
    $('#total-pago').html(suma)
    $('#faltante').html(faltante)
    if (faltante == 0) {
        $('#PAGAR').prop('disabled', false);
    } else {
        $('#PAGAR').prop('disabled', true);
    }

}
function AgCliente(idcliente, nombre) {
    $('#nombre_cliente').html(nombre)
    $('#cliente_id').val(idcliente)
}

function abrir_pagos() {
    if ($('#cliente_id').val() > 0) {
        if ($('#total').val() > 0) {
            $('#pagos').modal('show')
        } else {
            $.notify({
                title: "<strong>Respuesta:</strong> ",
                message: 'Agregue minimo un producto',
                icon: 'fa fa-times'
            }, {
                type: 'danger'
            });
        }
    } else {
        $.notify({
            title: "<strong>Respuesta:</strong> ",
            message: 'Falta agregar un cliente',
            icon: 'fa fa-times'
        }, {
            type: 'danger'
        });
    }

}
function Adpago(pago, id) {
    valor = document.getElementById("faltante").innerText
    item = '<tr class="success" id="' + j + '"><td><input type="text" name="pagos[' + j + '][pago]" value="' + pago +
        '" class="pago font-w600" readonly></td>' + '<td width="40%"><input type="text" name="pagos[' + j + '][valor]" value="' +
        valor + '" class="pago pagoitem" onchange="totalpago()" ></td>' +
        '<td><input type="hidden" name="pagos[' + j + '][id]" value="' + id + '"></td>' +
        '<td><a class="btn btn-danger btn-xs" href="#" onclick="eliminar_pago(' + j + ')" role="button">' +
        '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td></tr>'
    $('#pagos-item').append(item)
    totalpago()
    j++
}
function eliminar_pago(id) {
    $('#pagos-item').find('#' + id).html('')
    totalpago()
}

function anular(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    return (tecla != 13);
}
function vaciar() {
    $('.productos').html('')
    subtotal()
}
function cantidad(){
    subtotal()
}
function AgItem(id, valor, img, nombre, iva, remision, compra) {
    var Content = '';
    iva = iva * compra;
    Content = '<div class="producto" ><div class="col-sm-3 col-xs-6 hidden-sm hidden-md"><img src="/' + img +
        '" class="img-circle img-corona" width="60px"></div><div class="info col-sm-12 col-md-9 col-xs-6">' +
        '<input type="text" name="items[' + i + '][nombre]" value="' + nombre + '" class="nombre font-w600" readonly>' +
        '<input type="text" name="items[' + i + '][valor]" value="' + valor + '" class="precio" readonly>' +
        '<input type="hidden" name="items[' + i + '][iva]" value="' + iva + '" class="iva">' +
        '<input type="number" name="items[' + i + '][cantidad]" value="1" class="cantidad" onclick="javascript:cantidad();" onchange="javascript:cantidad();">' +
        '<input type="hidden" name="items[' + i + '][sub_total]" value="' + valor + '" class="sub_total">' +
        '<input type="hidden" name="items[' + i + '][dto]" value="0" class="dto">' +
        '<input type="hidden" name="items[' + i + '][id]" value="' + id + '" class="id">' +
        '<input type="hidden" name="items[' + i + '][compra]" value="' + compra + '" class="compra">' +
        '<input type="hidden" name="items[' + i + '][remision]" value="' + remision + '" class="remision"></div></div>';
    $('.productos').append(Content);
    i++;
    subtotal()
}
function subtotal() {
    var suma = 0, iva = 0, subDTO = 0, Subtotal = 0, subIVA = 0, rete = 0;
    $('.producto').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
        suma += parseInt($(this).find('.precio').val() || 0, 10) * parseInt($(this).find('.cantidad').val() || 0, 10)//numero de la celda 3
        subIVA += parseInt($(this).find('.iva').val() || 0, 10)
    })
    descuento = $('#descuento').val();

    Subtotal = suma - subIVA
    suma = suma - descuento
    //alert(suma)
    $('#subtotal').val(Subtotal);
    $('#IVA').val(subIVA);
    $('#total').val(suma);
}
function buscar() {
    var data = $('.productos_pos').data("productos"); //obtengo los productos que cargue
    var successContent = '';
    for (datos in data) {
        remision = ''
        if (data[datos].remision > 0) {
            remision = '<span class="badge badge-red badge-left">R</span>';
        }
        successContent += '<div class="unidad text-center"><a href="#"  onclick="return AgItem(\'' + data[datos].codigo +
            '\',\'' + data[datos].productos_configurables.productos.venta + '\',\'' +
            data[datos].productos_configurables.productos.imagen + '\',\'' + data[datos].productos_configurables.producto +
            '\',\'' + data[datos].iva + '\',\'' + data[datos].remision + '\',\'' + data[datos].compra +
            '\')"><img src="/' + data[datos].productos_configurables.productos.imagen + '" class="img-responsive" alt="'
            + data[datos].nombre + '"><span class="label label-primary texto"><small>' + data[datos].productos_configurables.producto + '</small></span></img>' +
            '<span class="badge badge-secondary badge-right">' + data[datos].cantidad + '</span>' + remision + '</a></div>';
    }
    $('.productos_pos').html(successContent);

}
function categoria(id) {
    $('.categoria').hide();
    $('.id_' + id).show();
    var data = $('.productos_pos').data("productos"); //obtengo los productos que cargue
    var successContent = '';
    for (datos in data) {
        if (data[datos].productos_configurables.productos.categoria_id == id) {
            remision = ''
            if (data[datos].remision > 0) {
                remision = '<span class="badge badge-red badge-left">R</span>';
            }
            successContent += '<div class="unidad text-center"><a href="#"  onclick="return AgItem(\'' + data[datos].codigo +
                '\',\'' + data[datos].productos_configurables.productos.venta + '\',\'' +
                data[datos].productos_configurables.productos.imagen + '\',\'' + data[datos].productos_configurables.producto +
                '\',\'' + data[datos].iva + '\',\'' + data[datos].remision + '\',\'' + data[datos].compra +
                '\')"><img src="/' + data[datos].productos_configurables.productos.imagen + '" class="img-responsive" alt="'
                + data[datos].nombre + '"><span class="label label-primary texto"><small>' + data[datos].productos_configurables.producto + '</small></span></img>' +
                '<span class="badge badge-secondary badge-right">' + data[datos].cantidad + '</span>' + remision + '</a></div>';

        }
    }
    $('.productos_pos').html(successContent);
}

$('#buscar_producto').keyup(function () {
    term = $('#buscar_producto').val();
    var data = $('.productos_pos').data("productos"); //obtengo los productos que cargue
    var successContent = '';
    console.log(data)
    for (datos in data) {
        if (data[datos].productos_configurables.producto.toLowerCase().indexOf(term) != -1) {
            remision = ''
            if (data[datos].remision > 0) {
                remision = '<span class="badge badge-danger badge-left">R</span>';
            }
            successContent += '<div class="unidad text-center"><a href="#"  onclick="return AgItem(\'' +
                data[datos].codigo + '\',\'' + data[datos].productos_configurables.productos.venta + '\',\'' +
                data[datos].productos_configurables.productos.imagen + '\',\'' +
                data[datos].productos_configurables.producto + '\',\'' + data[datos].iva + '\',\'' +
                data[datos].remision + '\',\'' + data[datos].compra + '\')"><img src="/' +
                data[datos].productos_configurables.productos.imagen + '" class="img-responsive" alt="' +
                data[datos].nombre + '"><span class="label label-primary texto"><small>' +
                data[datos].productos_configurables.producto + '</small></span></img>' +
                '<span class="badge badge-secondary badge-right">' + data[datos].cantidad + '</span>' +
                remision + '</a></div>';
        }

    }
    $('.productos_pos').html(successContent);
});

function buscador() {
    if ($('.buscador').is(':hidden'))
        $('.buscador').show();
    else
        $('.buscador').hide();
}