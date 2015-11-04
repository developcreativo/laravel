/**
 * Created by userpc on 1/11/2015.
 */
var i = 0
var j = 0
function abrir_pagos(e) {

    event.preventDefault(); // para FF standard
    event.returnValue = false; // para IE
    if ($('#valor').val() > 0) {
        if ($('#concepto').val().length > 0) {
            $('#pagos').modal('show');
            valor = $('#valor').val()
            $('#total-pago').html(valor)
            $('#faltante').html(valor)
            $('#PAGAR').prop('disabled', true);
        } else {
            $.notify({
                title: "<strong>Respuesta:</strong> ",
                message: 'Agregue un concepto',
                icon: 'fa fa-times'
            }, {
                type: 'danger'
            });
        }
    } else {
        $.notify({
            title: "<strong>Respuesta:</strong> ",
            message: 'Agregue un valor',
            icon: 'fa fa-times'
        }, {
            type: 'danger'
        });
    }


}

function abrir_pagos_factura(e) {

    event.preventDefault(); // para FF standard
    event.returnValue = false; // para IE
    if ($('#total').val() > 0) {
        $('#pagos').modal('show');
        valor = $('#total').val()
        $('#total-pago').html(valor);
        $('#faltante').html(valor);
        $('#PAGAR').prop('disabled', true);
    } else {
        $.notify({
            title: "<strong>Respuesta:</strong> ",
            message: 'Agregue minimo una factura',
            icon: 'fa fa-times'
        }, {
            type: 'danger'
        });
    }


}

function totalpago() {
    total = document.getElementById("total-pago").innerText
    var suma = 0
    $('.pagoitem').each(function () {
        suma += parseInt($(this).val())
    })
    faltante = total - suma
    $('#faltante').html(faltante)
    if (faltante == 0) {
        $('#PAGAR').prop('disabled', false);
    } else {
        $('#PAGAR').prop('disabled', true);
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

function agregaritems(id, valor, nombre, factura) {

    var successContent = '<tr class ="dato" id="' + i + '">' +

        '<td class="font-w600 text-center text-info">' +
        '<input class="form-control " value="' + factura + '" name="items[' + i + '][factura]" type="text" readonly></td>' +

        '<td class="font-w600">' +
        '<input class="form-control " value="' + nombre + '" name="items[' + i + '][nombre]" type="text" id="nombre' + i + '" readonly></td>' +

        '<td class="text-center font-w600 text-success">' +
        '<input class="form-control  val" onkeyup="subtotal()" value="' + valor + '" name="items[' + i + '][valor]" id="valor' + i + '" type="number"></td>' +

        '<td><a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Eliminar" href="#" onclick="return deletetr(' + i + ')">' +
        '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>' +

        '<input type="hidden" name="items[' + i + '][id]" value="' + id + '">' +

        '</tr>';

    $('#tabla-pagar').append(successContent);

    i++;

    subtotal();


}

function subtotal() {

    var suma = 0;

    $('#tabla-pagar tr').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas

        suma += parseFloat($(this).find('.val').val() || 0, 10) //numero de la celda 3

    })


    $('#total').val(suma.toFixed(2));


}

function deletetr(id) {

    $('#' + id).html('');

    subtotal();


}
