/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

      $(document).ready(function(){ 

        var table = $("#the_table").dataTable({ 
          "processing":true,
          "serverSide":true,
          "scrollX":true,
          "scrollColapse":true,
          "columns": [
              { "width": "10%"},
              { "width": "35%"},
              { "width": "25%"},
              { "width": "3%"},
              { "width": "3%"},
              { "width": "20%"},
              { "width": "20%"},
              { "width": "3%"},
              { "width": "3%"},
              { "width": "3%"},
              { "width": "3%"}
          ],
/*
 *          El llamado del ajax es para listar todos los contribuyentes desde la base de datos
 */
          "ajax": "./include/getContribuyente.php"
        }); 
        new $.fn.dataTable.FixedColumns( table, {
            leftColumns: 1
        } );
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
//           var pasa = '';
           $(".selected").map( function()
           {
               var $fila = $(this);
               var ruc = $fila.find(':nth-child(1)').text();
               pasa = '{"Ruc":"' + ruc + '",';
               var razon = $fila.find(':nth-child(2)').text();
               pasa += '"Razon":"' + razon + '",';
               var comercial = $fila.find(':nth-child(3)').text();
               var estab = $fila.find(':nth-child(4)').text();
               var punto = $fila.find(':nth-child(5)').text();
               var matriz = $fila.find(':nth-child(6)').text();
               var emisor = $fila.find(':nth-child(7)').text();
               var contab = $fila.find(':nth-child(8)').text();
               var resol = $fila.find(':nth-child(9)').text();
               var ambiente = $fila.find(':nth-child(10)').text();
               var emision = $fila.find(':nth-child(11)').text();
               pasa += '"Comercial":"' + comercial + '",';
               pasa += '"Establecimiento":"' + estab + '",';
               pasa += '"Punto Emision":"' + punto + '",';
               pasa += '"Direccion matriz":"' + matriz + '",';
               pasa += '"Direccion Emisor":"' + emisor + '",';
               pasa += '"Lleva Contabilidad":"' + contab + '",';
               pasa += '"Especial":"' + resol + '",';
               pasa += '"Ambiente":"' + ambiente + '",';
               pasa += '"Emision":"' + emision + '"}';
               console.log( "Datos:" + pasa);
           }).get();
  
           $.ajax(
                   {
                    "url":"./include/selecContribuyente.php",
                    "method":"POST",
                    "data":{"Contribuyente": pasa},
                    "dataType":"text",
//                    "contentType": "application/json",
                    "contentType": "application/x-www-form-urlencoded; charset=UTF-8",
                    "beforeSend": function(){
//                        alert("Este es para JSON: " + pasa);
                    },
                    error: function( xhr, status, errorThrown ) {
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                        alert( "check ");
                        document.cookie='Errores="*** ERROR No se han seleccionado el contribuyente ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraMensajes.php';
                    },
                    "success": function( datos ) {
//                        alert( datos );
                    if(datos ==  "Se acceso al registro del Contribuyente") {
                        document.cookie='Continuar="--- Contribuyente Seleccionado puede continuar ---"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraContinuar.php';
                    } else if( datos == "No se acceso al registro del Contribuyente") {
                        document.cookie='Continuar="--- ERROR No se acceso al registro del Contribuyente ---"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraContinuar.php';
                    }
                    },

                    "complete": function( xhr, status ) {
//                    alert( "The request is complete!" );
                    }
                   });
       });
      }); 
 
