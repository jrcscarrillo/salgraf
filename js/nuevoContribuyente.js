/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(function() {
        $("#sky-form").validate({
            rules : {
                rucForm : {
                    minlength : 13,
                    maxlength : 13,
                    required : true,
                    digits : true
                },
                razonForm : {
                    required : true
                },
                comercialForm : {
                    required : true
                },
                matrizForm : {
                    required : true
                },
                emisorForm : {
                    required : true
                },
                estabForm : {
                    required : true,
                    minlength : 3,
                    maxlength : 3,
                    digits : true
                },
                puntoForm : {
                    required : true,
                    minlength : 3,
                    maxlength : 3,
                    digits : true
                },
                llevaForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 1
                },
                ambienteForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 1,
                    digits : true
                },
                emisionForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 1,
                    digits : true
                },
                tokenForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 1,
                    digits : true
                },
                emailForm : {
                    required : true,
                    email : true
                },
                telefonoForm : {
                    required : true,
                    minlength : 7,
                    maxlength : 9,
                    digits : true
                },
                file : {
//                    required : true,
                    extension : "png|jpe?g|gif"
                }
            },
            messages : {
                rucForm : {
                    required : 'Ingrese su numero de RUC',
                    minlength : "Minimo 13 digitos",
                    maxlength : "Maximo de 13 digitos",
                    digits : "Solo ingrese digitos"
                },
                emailForm : {
                    required : 'Ingrese su correo electronico',
                    email : 'Ingrese una direccion valida'
                },
                telefonoForm : {
                    required : 'Ingrese un numero de telefono',
                    minlength : "Minimo 7 digitos",
                    maxlength : "Maximo de 9 digitos"
                },
                razonForm : {
                    required : 'Ingrese la razon social de su negocio'
                },
                comercialForm : {
                    required : 'Ingrese su nombre de batalla'
                },
                matrizForm : {
                    required : 'Ingrese la direccion de la oficina principal'
                },
                emisorForm : {
                    required : 'Ingrese la direccion de su oficina de facturacion'
                },
                estabForm : {
                    required : 'Ingrese el codigo del establecimiento',
                    minlength : "Minimo 3 digitos",
                    maxlength : "Maximo de 3 digitos",
                    digits : "Solo ingrese digitos"
            },
            puntoForm : {
                    required : 'Ingrese el punto de emision',
                    minlength : "Minimo 3 digitos",
                    maxlength : "Maximo de 3 digitos",
                    digits : "Solo ingrese digitos"
            },
            llevaForm : {
                    required : 'Ingrese SI o NO'
            },
            ambienteForm : {
                    required : 'Ingrese ambiente de produccion o pruebas',
                    minlength : "Minimo 1 digito",
                    maxlength : "Maximo de 1 digito",
                    digits : "Solo ingrese digitos"
            },
            emisionForm : {
                    required : 'Ingrese tipo emision normal o contingencia',
                    minlength : "Minimo 1 digito",
                    maxlength : "Maximo de 2 digito",
                    digits : "Solo ingrese digitos"
            },
            file: {
                    extension: "Solo acepta archivos tipo png, gif, o jpg"
            },
            tokenForm : {
                    required : 'Ingrese el tipo de certificado',
                    minlength : "Minimo 1 digito",
                    maxlength : "Maximo de 1 digito",
                    digits : "Solo ingrese digitos"
            }
    },
submitHandler : function(form) {
    $(form).ajaxSubmit({
            beforeSend : function() {
                    if (window.File && window.FileList && window.FileReader) {
                            //alert($("#file").val());
                            $("#incluya").attr("placeholder", $("#file").val() );
                    }
                    $('#sky-form button[type="submit"]').addClass('button-uploading').attr('disabled', true);
            },
            uploadProgress : function(event, position, total, percentComplete) {
                    $("#sky-form .progress").text(percentComplete + '%');
            },
            error: function( xhr, status, errorThrown ) {
                        document.cookie='Errores="*** ERROR No se ha podido proceder a registrar un nuevo contribuyente ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraMensajes.php';
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },
            success : function( datos ) {
//                alert( datos );
                if( datos == "Contribuyente adicionado se envio email") {
                    $("#sky-form").addClass('submited');
                    $('#sky-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                } else if( datos == "Contribuyente adicionado NO se envio email") {
                 document.cookie='Continuar="--- Error Contribuyente adicionado NO se envio email ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "No existe Contribuyente") {
                 document.cookie='Continuar="--- Error No existe Contribuyente ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Codigo establecimiento y punto de emision Ya Existen") {
                 document.cookie='Continuar="--- Error Codigo establecimiento y punto de emision Ya Existen ---"';
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
