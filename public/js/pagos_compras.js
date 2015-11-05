/**
 * Created by userpc on 4/11/2015.
 */
var i = 0
var j = 0
function abrir_pagos(e) {

    event.preventDefault(); // para FF standard
    event.returnValue=false; // para IE
    $('#pagos').modal('show');
    var valor = $('#pagar').data('pago');
    $('#total-pago').html('0')
    $('#faltante').html(valor)
    $('#PAGAR').prop('disabled', true);

}

function totalpago() {
    var total = $('#pagar').data('pago');
    var faltante
    var suma = 0
    $('.pagoitem').each(function () {
        suma += parseInt($(this).val())
    })
    faltante = total - suma
    $('#total-pago').html(suma)
    $('#faltante').html(faltante)
    $('#PAGAR').prop('disabled', false);


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