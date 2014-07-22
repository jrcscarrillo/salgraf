/* 
 * @Author      Juan Carrillo
 * @Project     Comprobantes Electronicos
 * @Date        22 de Julio del 2014
 */

$(function() {
    $("#sky-form").validate({
        rules : {
            emailForm : {
                required : true,
                email : true
            }
        },
        messages : {
            emailForm : {
                required : 'Ingrese su correo electronico',
                email : 'Ingrese una direccion valida'
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
            success : function( datos ) {
//                alert ( datos );
                if(datos ==  "Usuario Habilitado se envio Email") {
                 $( "#sky-form" ).addClass( 'submited' );
                 $( '#sky-form button[type="submit"]' ).removeClass('button-uploading').attr('disabled', false);
             } else if( datos == "Error usuario no se habilito") {
                 document.cookie='Continuar="--- Error usuario no se adiciono error en la base de datos ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Usuario no tiene autorizacion") {
                 document.cookie='Continuar="--- Error usuario no tiene autorizacion para realizar esta funcion ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Ya esta habilitado") {
                 document.cookie='Continuar="--- Error usuario previamente habilitado ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Usuario no existe") {
                 document.cookie='Continuar="--- Error Usuario no existe ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Usuario Habilitado no se envio Email") {
                 document.cookie='Continuar="--- Error usuario se habilito pero email rechazado REVISE EMAIL ---"';
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
