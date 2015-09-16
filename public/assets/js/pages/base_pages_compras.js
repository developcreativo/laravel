/**
 * Created by userpc on 2/09/2015.
 */
/*
 *  Document   : base_pages_login.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Compras Page
 */

var BasePagesCompras = function() {
    // Init Login Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationLogin = function(){
        jQuery('.js-validation-compras').validate({
            errorClass: 'help-block text-right animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group .form-material').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            rules: {
                'factura': {
                    required: true

                },
                'fecha': {
                    required: true
                },
                'total': {
                    required: true,
                    number: true
                }
            },
            messages: {
                'factura': 'Por favor ingresa un email valido',
                'fecha':  'Por favor ingresa tu contrase�a',
                'total':  'Por favor ingresa tu contrase�a'
            }
        });
    };

    return {
        init: function () {
            // Init Login Form Validation
            initValidationLogin();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BasePagesCompras.init(); });
