/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $("#sky-form").validate( {
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        messages: {
            email: {
                required: 'Por favor, Ingrese una direccion email',
                email: 'Por favor, Ingrese una direccion email valida'
            },
            password: {
                required: 'Por favor, Ingrese una clave de seguridad'
            }
        },
    errorPlacement: function(error, element) {
        error.insertAfter(element.parent());
            }
        });
        $("#sky-form2").validate( {
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: 'Por favor, Ingrese una direccion email',
                    email: 'Por favor, Ingrese una direccion email valida'
                }
            },
        submitHandler: function(form) {
            $(form).ajaxSubmit( {
                beforeSend: function() {
                    $('#sky-form button[type="submit"]').attr('disabled', true);
                },
                success: function(datos) {
                    correMensaje( datos );
                }
            });
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });
});
   function correMensaje( datos ){
       alert('Login YA');
       if( datos === "YA" ){
            document.cookie='Continuar="--- Usuario ya esta ingresado en el sistema ---"';
             window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Calcograf/paraContinuar.php';
       } else {
           
                    $("#sky-form2").addClass('submited');
       }
 }
