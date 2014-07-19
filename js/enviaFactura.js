/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

      $(document).ready(function(){ 

        var table = $("#the_table").dataTable({ 
          "processing":true,
          "serverSide":true,
//          "scrollX":true,
          "scrollColapse":true,
          "columns": [
              { "width": "55%"},
              { "width": "15%"},
              { "width": "15%"},
              { "width": "15%"}
          ],
/*
 *          El llamado del ajax es para listar todos los archivos XML desde la base de datos
 */
          "ajax": "./include/getArchivo.php"
        }); 
//        new $.fn.dataTable.FixedColumns( table, {
//            leftColumns: 1
//        } );
        $('#the_table tbody').on( 'click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        } );

       $("#button").click( function(e) 
       {
           e.preventDefault();
           var pasa = '';
           $(".selected").map( function()
           {
               var $fila = $(this);
               var archivo = $fila.find(':nth-child(1)').text();
               pasa += '{"Nombre_Archivo":"' + archivo + '",';
               var generado = $fila.find(':nth-child(2)').val();
               pasa += '"Generado":"' + generado + '",';
               var descargado = $fila.find(':nth-child(3)').text();
               var procesado = $fila.find(':nth-child(4)').text();
               pasa += '"Descargado":"' + descargado + '",';
               pasa += '"Procesado":"' + procesado + '",';
               console.log( "Datos: " + pasa);
           }).get();
  
           $.ajax(
                   {
                    "url":"./include/enviaFactura.php",
                    "method":"POST",
                    "data":{"Archivo": pasa},
                    "dataType":"json",
//                    "contentType": "application/json; charset=UTF-8",
                    "beforeSend": function(){
                        alert("Este es para JSON: " + pasa);
                    },

                    success: function( datos ) {
                        correMensaje( datos ) 
                    },

                    error: function( xhr, status, errorThrown ) {
                        document.cookie='Errores="*** ERROR No se pudo seleccionar el archivo XML para procesar ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Aurora/paraMensajes.php';
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },
                    complete: function( xhr, status ) {
//                    alert( "The request is complete!" );
                    }
                   });
       });
      }); 
   function correMensaje( datos ){
       if( datos = "GO" ){
            document.cookie='Continuar="---Se ha seleccionado con exito el archivo XML desde el servidor ---"';
             window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Aurora/paraContinuar.php';
       }
 }
