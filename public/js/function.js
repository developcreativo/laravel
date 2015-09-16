$(document).ready(function() {
    //petición al enviar el formulario de registro
    var form = $('#ajax');
    form.bind('submit',function () {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                beforeSend: function(){
                    $('.preload_users').append('<img src="img/loading.gif" />');
                    $('#tabla-todos').html('');
                },
                complete: function(data){
                    
                },
                success: function (data) {
                    $('.preload_users').html('');
                    // $('#tabla-todos').html('');
                    // $('#load_ajax').html(usuarios)
                    var usuarios = '';     
                    for(datos in data.productos){
                        
                        usuarios += '<tr>';
                        usuarios += '<td><a href="http://contapp.com.co/productos/'+ data.productos[datos].codigo +'">' + data.productos[datos].codigo + '</a></td>';
                        usuarios += '<td>' + data.productos[datos].producto + '</td>';
                        usuarios += '<td>$' + data.productos[datos].compra + '</td>';
                        usuarios += '<td>$' + data.productos[datos].venta + '</td>';
                        usuarios += '</tr>';
                    }
                    
                    $('#tabla-todos').html(usuarios);
                },
                error: function(errors){
                    $('.before').hide();
                    $('.errors_form').html('');
                    $('.errors_form').html(errors);
                }
            });
       return false;
    });
    
    
});