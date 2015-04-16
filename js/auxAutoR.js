/* 
 * @Author      Juan Carrillo
 * @Project     Comprobantes Electronicos
 * @Date(       18 de Julio del 2014
 */

$(function() {
    $("#sky-form").validate({
        rules : {
            passForm : {
                minlength : 6,
                maxlength : 23,
                required : true
            },
            nombreForm : {
                required : true,
                minlength : 3,
                maxlength : 30
            },
            apellidoForm : {
                required : true,
                minlength : 3,
                maxlength : 30
            },
            emailForm : {
                required : true,
                email : true
            }
        },
        messages : {
            passForm : {
                required : 'Ingrese una password valida',
                minlength : "Minimo 6 caracteres",
                maxlength : "Maximo 23 caracteres"
            },
            nombreForm : {
                required : 'Ingrese un nombre valido',
                minlength : "Minimo 3 caracteres",
                maxlength : "Maximo 30 caracteres"
            },
            emailForm : {
                required : 'Ingrese su correo electronico',
                email : 'Ingrese una direccion valida'
            },
            apellidoForm : {
                required : 'Ingrese un apellido valido',
                minlength : "Minimo 3 caracteres",
                maxlength : "Maximo 30 caracteres"
        }
    },
submitHandler : function(form) {
    $(form).ajaxSubmit({
        beforeSend : function() {
            $('#sky-form button[type="submit"]').addClass('button-uploading').attr('disabled', true);
            },
            uploadProgress : function(event, position, total, percentComplete) {
                    $("#sky-form .progress").text(percentComplete + '%');
            },
            success : function(datos) {
//                correMensaje( datos );
                if(datos ==  "Usuario adicionado") {
                 $( "#sky-form" ).addClass( 'submited' );
                 $( '#sky-form button[type="submit"]' ).removeClass('button-uploading').attr('disabled', false);
             } else if( datos == "Error usuario no se adiciono") {
                 document.cookie='Continuar="--- Error usuario no se adiciono error en la base de datos ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Nombre de Usuario Ya Existe") {
                 document.cookie='Continuar="--- Error usuario no se adiciono Nombre de usuario ya existe ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Password Invalida") {
                 document.cookie='Continuar="--- Error usuario no se adiciono Password invalida ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             }
        }
    });
},
errorPlacement : function(error, element) {
    error.insertAfter(element.parent());
}
});
});
