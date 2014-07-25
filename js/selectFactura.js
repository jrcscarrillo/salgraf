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
              { "width": "5%"},
              { "width": "5%"},
              { "width": "20%"},
              { "width": "5%"}
          ],
          "ajax": "./include/getFactura.php"
        }); 
        new $.fn.dataTable.FixedColumns( table, {
            leftColumns: 1
        } );
        $('#the_table tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $("#button1").click( function(e) {
            e.preventDefault();
            window.location ='./index3.html'; 
        });
       $("#button").click( function(e) 
       {
           e.preventDefault();
           var total = 0;
//           var pasa = '{ "Facturas": [ ';
           var pasa = '';
           $(".selected").map( function()
           {
               var $fila = $(this);
               var numero = $fila.find(':nth-child(1)').text();
               pasa += '{"Numero":"' + numero + '",';
               var cliente = $fila.find(':nth-child(2)').text();
               pasa += '"Cliente":"' + cliente + '",';
               var valor = $fila.find(':nth-child(6)').text();
               total = total + parseFloat(valor);
               pasa += '"Valor":"' + valor + '"},';
               console.log( "Factura: " + numero + " Cliente: " + cliente + " Acumulado Ventas: " + total);
           }).get();
       
           $.ajax(
                   {
                    "url":"./include/selecFactura.php",
                    "method":"POST",
                    "data":{"Facturas": pasa},
                    "dataType":"json",
//                    "contentType": "application/json; charset=UTF-8",
                    "beforeSend": function(){
//                        alert("Este es para JSON: " + pasa);
                    },

                    success: function( datos ) {
                        document.cookie='Continuar="---Se han seleccionado con exito las facturas desde Quickbooks---"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraContinuar.php';
       
                    },

                    error: function( xhr, status, errorThrown ) {
                        document.cookie='Errores="*** ERROR No se han seleccionado las facturas ***"';
                        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' ) + 1 ) + '../Salgraf/paraMensajes.php';
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },

                    complete: function( xhr, status ) {
//                        $("div.boxed").html('<br><br><br><br><hr><br><br><br><br><span style="color:red;text-align:center">Proceso de Seleccion de Facturas ha concluido satisfactoriamente</span><br><br><a href="index.html">CONTINUAR</a><br><br><br><br><hr><br><br><br><br>');
                    }
                   });
       return false;
       });
      }); 
