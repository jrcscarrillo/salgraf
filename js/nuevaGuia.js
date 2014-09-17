/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(function() {
        $("#sky-form").validate({
            rules : {
                nroGuiaForm : {
                    minlength : 5,
                    maxlength : 9,
                    required : true,
                    digits : true
                },
                tipoIDDestinoForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 2,
                    digits : true
                },
                fechaGuiaForm : {
                    required : true
                },
                numeroIDDestinoForm : {
                    required : true,
                    minlength : 10,
                    maxlength : 13,
                    digits : true
                },
                dirPartidaForm : {
                    required : true
                },
                dirDestinoForm : {
                    required : true
                },
                motivoForm : {
                    required : true
                },
                tipoIDTransporteForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 2,
                    digits : true
                },
                numeroIDTransporteForm : {
                    required : true,
                    minlength : 10,
                    maxlength : 13,
                    digits : true
                },
                razonTransporteForm : {
                    required : true
                },
                emailTransporteForm : {
                    required : true,
                    email : true
                },
                telTransporteForm : {
                    required : true,
                    minlength : 7,
                    maxlength : 9,
                    digits : true
                },
                tipoDocRespaldoForm : {
                    required : true,
                    minlength : 1,
                    maxlength : 2,
                    digits : true
                },
                numeroDocRespaldoForm : {
                    required : true,
                    minlength : 5,
                    maxlength : 9,
                    digits : true
                },
                fechaDocRespaldoForm : {
                    required : true
                },
                fechaInicioTForm : {
                    required : true
                },          
                fechaFinTForm : {
                    required : true
                },       
                rutaForm : {
                    required : true
                },  
                productosForm : {
                    required : true
                },    
                razonForm : {
                    required : true
                },                    
                embalajeForm : {
                    required : true
                }                
            },
            messages : {
                nroGuiaForm : {
                    required : 'Ingrese el numero de la GUia',
                    minlength : "Minimo 5 digitos",
                    maxlength : "Maximo de 9 digitos",
                    digits : "Solo ingrese digitos"
                },
                emailTransporteForm : {
                    required : 'Ingrese su correo electronico',
                    email : 'Ingrese una direccion valida'
                },
                telTransporteForm : {
                    required : 'Ingrese un numero de telefono',
                    minlength : "Minimo 7 digitos",
                    maxlength : "Maximo de 9 digitos"
                },
                fechaGuiaForm : {
                    required : 'Ingrese la fecha de la Guia de Remision'
                },
                tipoIDDestinoForm : {
                    required : 'Ingrese el codigo de documento'
                },
                numeroIDDestinoForm : {
                    required : 'Ingrese el numero de identificacion',
                    minlength : "Minimo de 10 digitos",
                    maxlength : "Maximo de 13 digitos",
                    digits : "Solo Ingrese numeros"         
                },
                dirPartidaForm : {
                    required : 'Ingrese la direccion de partida para este embarque'
                },
                dirDestinoForm : {
                    required : 'Ingrese la direccion del destino para este embarque'
                },

            motivoForm : {
                    required : 'Ingrese el motivo'
            },

            tipoIDTransporteForm : {
                    required : "Ingrese el tipo de documento"
            },
            numeroIDTransporteForm : {
                    required : 'Ingrese el numero de identificacion',
                    minlength : "Minimo de 10 digitos",
                    maxlength : "Maximo de 13 digitos",
                    digits : "Solo Ingrese numeros"         
                },
            razonTransporteForm : {
                required : "Ingrese la razon social o nombres del transportista"
            },
            tipoDocRespaldoForm : {
                required : "Seleccione un valor"
            },
            numeroDocRespaldoForm : {
                    required : 'Ingrese el numero documento respaldo',
                    minlength : "Minimo de 5 digitos",
                    maxlength : "Maximo de 9 digitos",
                    digits : "Solo Ingrese numeros"                 
            },            
            placaForm : {
                    required : 'Ingrese el numero de la placa',
                    minlength : "Minimo de 6 caracteres",
                    maxlength : "Maximo de 7 caracteres"
            },
            fechaDocRespaldoForm : {
                required : "Seleccione una fecha"
            },
            fechaInicioTForm : {
                required : "Seleccione una fecha"
            },
            fechaFinTForm : {
                required : "Seleccione una fecha"
            },
            rutaForm : {
                required : "Ingresar datos para la ruta"
            },
            productosForm : {
                required : "Ingresar datos para identificar los productos"
            },            
            embalajeForm : {
                required : "Ingresar datos para la ruta"
            },
            razonForm : {
                required : "Ingresar la razon social o los Nombres del destinatario"
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
                        document.cookie='Errores="*** ERROR No se ha podido proceder a registrar una nueva guia ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraMensajes.php';
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },
            success : function( datos ) {
//                alert( datos );
                if( datos == "Guia adicionada se envio email datos y PDF") {
                    $("#sky-form").addClass('submited');
                    $('#sky-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                } else if( datos == "Guia adicionada NO se envio email") {
                 document.cookie='Continuar="--- Error Guia adicionada NO se envio email ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "No existe Guia") {
                 document.cookie='Continuar="--- Error No existe Guia ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Numero de Guia o Identificacion Ya Existen") {
                 document.cookie='Continuar="--- Error Numero de Guia o Identificacion Ya Existen ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "Se genero PDF de la Guia adicionada") {
                 document.cookie='Continuar="--- Error Solo se genero el PDF de la guia Necesita buscar el archivo en el servidor ---"';
                 window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../salgraf/paraContinuar.php';
             } else if( datos == "No se genero PDF de la Guia adicionada") {
                 document.cookie='Continuar="--- Error No se genero el PDF de la guia Necesita buscar el archivo HTML en el servidor ---"';
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
