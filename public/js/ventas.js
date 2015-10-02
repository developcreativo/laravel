/**
 * Created by userpc on 18/09/2015.
 */
$('.departamento').change(function () {
    id = $('.departamento').val()
    var data = $('.ciudad').data('ciudad')
    var successContent = '';
    for (datos in data) {
        if (data[datos].departamento_id == id) {
            successContent += '<option value="' + data[datos].id + '">' + data[datos].ciudad + '</option>'
        }
    }
    $('.ciudad').html(successContent);

});


function deletetr(id) {

    $('#' + id).html('');

    subtotal();


}

var i = 0;
var j = 0;

function agregaritems(id, valor, nombre, iva, remision, compra) {

    var successContent = '<tr class ="dato" id="' + i + '"><td><input class="form-control input-sm" value="' + id + '" name="items[' + i + '][id]" type="text" readonly></td>' +

        '<td><input class="form-control input-sm cant" onkeyup="obtenerDatos(' + i + ')" value="1" name="items[' + i + '][cantidad]" type="text" id="cantidad' + i + '"></td>' +

        '<td><input class="form-control input-sm" value="' + nombre + '" name="items[' + i + '][nombre]" type="text" disabled></td>' +

        '<td><input class="form-control input-sm val" onkeyup="obtenerDatos(' + i + ')" value="' + valor + '" name="items[' + i + '][valor]" id="valor' + i + '" type="text"></td>' +

        '<td><input class="form-control input-sm iva" onkeyup="obtenerDatos(' + i + ')" value="0" name="items[' + i + '][iva]" id="iva' + i + '" type="text" ></td>' +

        '<td><input class="form-control input-sm dto" onkeyup="obtenerDatos(' + i + ')" value="0" name="items[' + i + '][dto]" id="dto' + i + '" type="text" ></td>' +

        '<td><input class="form-control input-sm sub" value="' + valor + '" name="items[' + i + '][sub_total]" id="sub_total' + i + '" type="text" readonly ></td>' +

        '<td> <a class="btn btn-danger btn-sm" href="#" onclick="return deletetr(' + i + ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>' +

        '<input type="hidden" name="items[' + i + '][remision]" value="' + remision + '">' +

        '<input type="hidden" name="items[' + i + '][compra]" value="' + compra + '">' +

        '</tr>';

    $('#tabla-todos').append(successContent);

    $('#buscar').val('');


    i++;

    subtotal();


    $('#productos-sugeridos').html('');


}
function obtenerDatos(id) {


    var celda_cantidad = '[id=cantidad' + id + ']',

        celda_valor = '[id=valor' + id + ']',

        celda_sub_total = '[id=sub_total' + id + ']',

        cantidad = parseInt($(celda_cantidad).val()),

        valor = parseInt($(celda_valor).val());

    var resultado = (valor) * (cantidad);

    $(celda_sub_total).val(resultado.toFixed(2));

    subtotal();

}

function subtotal() {


    var suma = 0, iva = 0, subDTO = 0, total = 0, subIVA = 0, rete = 0;


    $('#tabla-todos tr').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas

        suma += parseInt($(this).find('.sub').val() || 0, 10) //numero de la celda 3

        subDTO += (parseInt($(this).find('.cant').val()) * parseInt($(this).find('.val').val()) * (parseFloat($(this).find('.dto').val() / 100))) || 0, 10

        subIVA += ((parseInt($(this).find('.cant').val()) * parseInt($(this).find('.val').val())) * (1 - (parseFloat($(this).find('.dto').val() / 100)))) * (parseFloat($(this).find('.iva').val() / 100)) || 0, 10

    })

    rete = parseInt($('#compras #rete').val()) || 0

    total = suma - subDTO + subIVA - rete


    //alert(suma)

    $('#compras #subT').val(suma.toFixed(2));

    $('#compras #DTO').val(-subDTO.toFixed(2));

    $('#compras #iva').val(subIVA.toFixed(2));

    $('#compras #total').val(total.toFixed(2));


}


$('#buscar').keyup(function () {
    $('#productos-sugeridos').html('');
    term = $('#buscar').val()
    var data = $('#productos-sugeridos').data("productos"); //obtengo los productos que cargue
    var successContent = '';
    var i = 0
    if (term.length > 1) {
        for (datos in data) {
            console.log(data[datos])
            if (data[datos].productos_configurables.producto.toLowerCase().indexOf(term) != -1) {
                remision = ''
                if (data[datos].remision > 0) {
                    remision = '<span class="badge badge-danger">R</span>';
                }

                successContent += '<a href="#" class="list-group-item" onclick="return agregaritems(\'' +
                    data[datos].codigo + '\',\'' + data[datos].productos_configurables.productos.venta + '\',\'' +
                    data[datos].productos_configurables.producto + '\',\'' + data[datos].iva + '\',\'' +
                    data[datos].remision + '\',\'' + data[datos].compra + '\')">' +
                    data[datos].productos_configurables.producto + '<span class="badge">' +
                    data[datos].cantidad + '</span>' + remision + '<span class="badge badge-info">' +
                    data[datos].productos_configurables.productos.marcas.marca + '</span> </a>';
                i++
            }
            if (i === 3) {
                break;
            }


        }
    }
    $('#productos-sugeridos').html(successContent);


});

function AgCliente(id, documento, cliente, email, telefono, direccion) {
    $('.cliente_id').val(id);
    $('.cliente').val(cliente);
    $('.documento').val(documento);
    $('.email').val(email);
    $('.telefono').val(telefono);
    $('.direccion').val(direccion);
}

function abrir_pagos() {
    if ($('.cliente_id').val() > 0) {
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

$('#pagos').on('shown.bs.modal', function () {
    valor = $('#total').val()
    $('#total-pago').html('0')
    $('#faltante').html(valor)
    $('#PAGAR').prop('disabled', true);
    $('#tienda_id').val($('#tienda').val())

})


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
$('#despacho').change(function () {
    $('#content_despacho').show();
})
$(document).ready(function () {
    $('#content_despacho').hide();
})

