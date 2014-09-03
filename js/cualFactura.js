/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(function() {
        $("#sky-form").validate({
            rules : {
                facturaForm : {
                    minlength : 1,
                    maxlength : 9,
                    required : true,
                    digits : true
                }
            },
            messages : {
                facturaForm : {
                    required : 'Ingrese el numero de factura que convertira en guia de remision',
                    minlength : "Minimo 1 digito",
                    maxlength : "Maximo de 9 digitos",
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
                        document.cookie='Errores="*** ERROR No se ha podido encontar una factura ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraMensajes.php';
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },
            success : function( datos ) {
//                alert( datos );
                if( datos == "Factura encontrada se procede a generar la guia de remision") {
                    $("#sky-form").addClass('submited');
                    $('#sky-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                } else if( datos == "Factura no se ha encontrado") {
                 document.cookie='Continuar="--- Error Factura no se ha encontrado ---"';
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
