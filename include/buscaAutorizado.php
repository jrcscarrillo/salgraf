<?php

session_start();
$_SESSION['factura']['fechaAutorizacion'] = '2014-09-01';
$_SESSION['archivo'] = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/archivos/pre41153.xml';
$_SESSION['factura']['numeroAutorizacion'] = '1234567890123456789012345678';
grabaFacturaAutorizada();
poneFacturaAutorizada();

function poneFacturaAutorizada() {
    $doc = new DOMDocument();
    $archivo = $_SESSION['archivo'];
    $doc->load($archivo);
    $wk_RefNumber = intval($doc->getElementsByTagName('secuencial')->item(0)->nodeValue);
    
    include_once 'conectaQuickBooks.php';
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE invoice SET CustomField15 = 'AUTORIZADA' where RefNumber = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("s", $wk_RefNumber);
    $_SESSION['factura']['flag'] = "No se proceso Actualizacion de la factura seleccionada";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $_SESSION['factura']['flag']  = "*** ERROR No se ha actualizado la factura autorizada " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $_SESSION['factura']['flag']  = 'OK Se Actualizo la factura autorizada';
    }
//    var_dump($wk_RefNumber . ' flag ' . $nroRegistrosAfectados);
    $stmt->close();
    $db->close();
}

function grabaFacturaAutorizada() {
    include_once 'conexionDB.php';
    $doc = new DOMDocument();
    $archivo = $_SESSION['archivo'];
    $doc->load($archivo);
    $_SESSION['factura']['ambiente'] = $doc->getElementsByTagName('ambiente')->item(0)->nodeValue;
    $_SESSION['factura']['tipoEmision'] = $doc->getElementsByTagName('tipoEmision')->item(0)->nodeValue;
    $_SESSION['factura']['ruc'] = $doc->getElementsByTagName('ruc')->item(0)->nodeValue;
    $_SESSION['factura']['claveAcceso'] = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
    $_SESSION['factura']['estab']= $doc->getElementsByTagName('estab')->item(0)->nodeValue;
    $_SESSION['factura']['ptoEmi'] = $doc->getElementsByTagName('ptoEmi')->item(0)->nodeValue;
    $_SESSION['factura']['codDoc'] = $doc->getElementsByTagName('codDoc')->item(0)->nodeValue;
    $_SESSION['factura']['secuencial'] = $doc->getElementsByTagName('secuencial')->item(0)->nodeValue;
    $_SESSION['factura']['fechaEmision'] = $doc->getElementsByTagName('fechaEmision')->item(0)->nodeValue;
    $_SESSION['factura']['tipoIdentificacion'] = $doc->getElementsByTagName('tipoIdentificacionComprador')->item(0)->nodeValue;
    $_SESSION['factura']['identificacionComprador'] = $doc->getElementsByTagName('identificacionComprador')->item(0)->nodeValue;
    $_SESSION['factura']['razonSocialComprador'] = $doc->getElementsByTagName('razonSocialComprador')->item(0)->nodeValue;
    $_SESSION['factura']['direccion'] = $doc->getElementsByTagName('dirEstablecimiento')->item(0)->nodeValue;
    $_SESSION['factura']['telefono'] = '';
    $_SESSION['factura']['propina'] = 0;
    $_SESSION['factura']['totalSinImpuesto'] = $doc->getElementsByTagName('totalSinImpuestos')->item(0)->nodeValue;
    $_SESSION['factura']['propina'] = $doc->getElementsByTagName('propina')->item(0)->nodeValue;
    $_SESSION['factura']['importeTotal'] = $doc->getElementsByTagName('importeTotal')->item(0)->nodeValue;
    $_SESSION['factura']['totalImpto'] = $_SESSION['factura']['importeTotal'] - $_SESSION['factura']['totalSinImpuesto'];
    $_SESSION['factura']['moneda'] = 'DOLAR' ;
    $_SESSION['factura']['estado'] =  'AUTORIZADA' ;
    $_SESSION['factura']['codMsg'] = '' ;
    $_SESSION['factura']['mensaje'] = '' ;
    $_SESSION['factura']['msgAd'] = '' ;
    $_SESSION['factura']['msgError'] = '' ;
    
    $db = conecta_DB();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $today = date("Y-m-d H:i:s");
    $wk_fecha = $_SESSION['factura']['fechaEmision'];
    $wk_fecha = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3/$2/$1', $wk_fecha);
    $sql = "insert into facturas(FacturasAmbiente, FacturasTipoEmision, FacturasRuc, FacturasClaveAcceso, FacturasEstab, FacturasCodDoc, FacturasPunto, FacturasSq, FacturasFechaEmision, FacturasTipoId, ";
    $sql .= "FacturasNroId, FacturasGuia, FacturasRazonComprador, FacturasImporteSinImpuesto, FacturasTotalImpto, ";
    $sql .= "FacturasPropina, FacturasImporteTotal, FacturasMoneda, FacturasEstado, FacturasFechaAutoriza, FacturasNumeroAutoriza, FacturasCodMsg, FacturasMensaje, FacturasMsgAdicional, FacturasTipoError";
    $sql .= ") values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("sssssssssssssssssssssssss", $_SESSION['factura']['ambiente'], $_SESSION['factura']['tipoEmision'], $_SESSION['factura']['ruc'], $_SESSION['factura']['claveAcceso'], $_SESSION['factura']['estab'], $_SESSION['factura']['codDoc'], $_SESSION['factura']['ptoEmi'], $_SESSION['factura']['secuencial'], $wk_fecha, $_SESSION['factura']['tipoIdentificacion'], $_SESSION['factura']['identificacionComprador'], $_SESSION['factura']['propina'], $_SESSION['factura']['razonSocialComprador'], $_SESSION['factura']['totalSinImpuesto'], $_SESSION['factura']['totalImpto'], $_SESSION['factura']['propina'], $_SESSION['factura']['importeTotal'], $_SESSION['factura']['moneda'], $_SESSION['factura']['estado'], $_SESSION['factura']['fechaAutorizacion'], $_SESSION['factura']['numeroAutorizacion'], $_SESSION['factura']['codMsg'], $_SESSION['factura']['mensaje'], $_SESSION['factura']['msgAd'], $_SESSION['factura']['msgError']);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    preparaFactura();
}
    function preparaFactura() {
    /*
     * Copiar el formato de la factura en HTML
     * Generar los campos desde el archivo XML enviado
     */
    $doc = new DOMDocument();
    $archivo = $_SESSION['archivo'];
    $doc->load($archivo);
    $param = 'fact' . $_SESSION['factura']['secuencial'] . '.html';
    $directorio = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/bootstrap-factura.html';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;
    copy($directorio, $salida);
    $doc1 = new DOMDocument();
    $doc1->loadHTMLFile($salida);
    
    $E_numeroFactura = $doc1->getElementById('numerofactura');
    $E_numeroauto = $doc1->getElementById('numeroauto');
    $E_fechaemision = $doc1->getElementById('fechaemision');
    $E_rucCliente = $doc1->getElementById('rucCliente');
    $E_razon = $doc1->getElementById('razon');
    $E_direccion = $doc1->getElementById('direccion');
    $E_telefono = $doc1->getElementById('telefono');
    $E_totalSinImpto = $doc1->getElementById('totalSinImpto');
    $E_valorImpto12 = $doc1->getElementById('valorImpto12');
//    $E_valorImpto0 = $doc1->getElementById('valorImpto0');
    $E_apagar = $doc1->getElementById('apagar');
    $E_codigo = $doc1->getElementsByTagName('td')->item(0);
    $E_descripcion = $doc1->getElementsByTagName('td')->item(1);
    $E_cantidad = $doc1->getElementsByTagName('td')->item(2);
    $E_pUnitario = $doc1->getElementsByTagName('td')->item(3);
    $E_dscto = $doc1->getElementsByTagName('td')->item(4);
    $E_parcial = $doc1->getElementsByTagName('td')->item(5);
    
    $uno = $doc1 -> createElement('p', $_SESSION['factura']['secuencial']);
    $dos = $doc1 -> createElement('p', $_SESSION['factura']['numeroAutorizacion']);
    $tres = $doc1 -> createElement('p', $_SESSION['factura']['fechaEmision']);
    $cuatro = $doc1 -> createElement('p', $_SESSION['factura']['ruc']);
    $cinco = $doc1 -> createElement('p', $_SESSION['factura']['razonSocialComprador']);
    $seis = $doc1 -> createElement('p', $_SESSION['factura']['direccion']);
    $siete = $doc1 -> createElement('p', $_SESSION['factura']['telefono']);
    $ocho = $doc1 -> createElement('p', $_SESSION['factura']['totalSinImpuesto']);
    $nueve = $doc1 -> createElement('p', $_SESSION['factura']['totalImpto']);
    $diez = $doc1 -> createElement('p', '');
    $once = $doc1 -> createElement('p', $_SESSION['factura']['importeTotal']);
    
    $E_numeroFactura -> appendChild($uno);
    $E_numeroauto -> appendChild($dos);
    $E_fechaemision -> appendChild($tres);
    $E_rucCliente -> appendChild($cuatro);
    $E_razon -> appendChild($cinco);
    $E_direccion -> appendChild($seis);
    $E_telefono -> appendChild($siete);
    $E_totalSinImpto -> appendChild($ocho);
    $E_valorImpto12 -> appendChild($nueve);
//    $E_valorImpto0 -> appendChild($diez);
    $E_apagar -> appendChild($once);
    
    $Tag_product = $doc->getElementsByTagName('detalle');
    $lineas = 0;
    foreach ($Tag_product as $producto) {
        if ( $producto->hasChildNodes() ) {
            foreach ( $producto->childNodes as $child ) {
                switch ($child->nodeName){
                    case 'codigoPrincipal':
                        $wk_codigo = $child->nodeValue;
                        break;
                    case 'descripcion':
                        $wk_descripcion = $child->nodeValue;
                        break;                    
                    case 'cantidad':
                        $wk_cantidad = $child->nodeValue;
                        break;                    
                    case 'precioUnitario':
                        $wk_pUnitario = $child->nodeValue;
                        break;
                    case 'descuento':
                        $wk_descuento = $child->nodeValue;
                        break;
                    case 'precioTotalSinImpuesto':
                        $wk_totalSinImpto = $child->nodeValue;
                        break;                    
                }
                }
        }
        $doce = $doc1 ->createElement('p' , $wk_codigo);
        $E_codigo ->appendChild($doce);
        $trece = $doc1 ->createElement('p' , $wk_descripcion);
        $E_descripcion ->appendChild($trece);
        $catorce = $doc1 ->createElement('p' , $wk_cantidad);
        $E_cantidad ->appendChild($catorce);
        $quince = $doc1 ->createElement('p' , $wk_pUnitario);
        $E_pUnitario ->appendChild($quince);
        $diezyseis = $doc1 ->createElement('p' , $wk_totalSinImpto);
        $E_parcial ->appendChild($diezyseis);
        $lineas++;
        }
      if ($lineas < 11){
          do {
              $doce = $doc1 ->createElement('p' , ' ');
              $E_codigo ->appendChild($doce);
              $trece = $doc1 ->createElement('p' , ' ');
              $E_descripcion ->appendChild($trece);
              $catorce = $doc1 ->createElement('p' , ' ');
              $E_cantidad ->appendChild($catorce);
              $quince = $doc1 ->createElement('p' , ' ');
              $E_pUnitario ->appendChild($quince);
              $diezyseis = $doc1 ->createElement('p' , ' ');
              $E_parcial ->appendChild($diezyseis);
              $lineas++;              
          } while ($lineas < 11);
      }  
      $doc1->saveHTMLFile($salida);
      include_once 'paraPrince.php';
      paraPrince($salida);
      enviaMailFactura();
    }
    
function enviaMailFactura() {

    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';

    $part = "<div><b>Numero de Factura: </b>" . $_SESSION['factura']['secuencial'] . "<br>";
    $part .= "<b>Numero de Autorizacion: </b" . $_SESSION['factura']['numeroAutorizacion'] . "<br>";
    $part .= "<b>Fecha Emision: </b" . $_SESSION['factura']['fechaEmision'] . "<br>";
    $part .= "<b>Fecha Autorizacion: </b" . $_SESSION['factura']['fechaAutorizacion'] . "<br>";
    $part .= "<b>Razon Social del Comprador</b>" . $_SESSION['factura']['razonSocialComprador'] . "<br>";
    $part .= "<b>Direccion</b>" . $_SESSION['factura']['direccion'] . "<br>";
    $part .= "<b>Valor sin impuestos</b>" . $_SESSION['factura']['totalSinImpuesto'] . "<br>";

    $part .= 'Esta factura se ha adicionado correctamente';

    $body = "<div><b>Numero de Factura: </b>" . $_SESSION['factura']['secuencial'] . "<br>";
    $body .= "<b>Numero de Autorizacion: </b" . $_SESSION['factura']['numeroAutorizacion'] . "<br>";
    $body .= "<b>Fecha Emision: </b" . $_SESSION['factura']['fechaEmision'] . "<br>";
    $body .= "<b>Fecha Autorizacion: </b" . $_SESSION['factura']['fechaAutorizacion'] . "<br>";
    $body .= "<b>Razon Social del Comprador</b>" . $_SESSION['factura']['razonSocialComprador'] . "<br>";
    $body .= "<b>Direccion</b>" . $_SESSION['factura']['direccion'] . "<br>";
    $body .= "<b>Valor sin impuestos</b>" . $_SESSION['factura']['totalSinImpuesto'] . "<br>";

    $body .= 'Esta factura se ha adicionado correctamente';
        
    
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $param = 'fact' . $_SESSION['factura']['secuencial'] . '.pdf';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;
    $paraemail['attach'] = $salida;
    $paraemail['subject'] = 'Factura Adicionada';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
//    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['email'] = 'jrcscarrillo@gmail.com';
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
//    var_dump($paraemail);
    $_SESSION['factura']['flagEmail']  = enviamail($paraemail);
    return $_SESSION['factura']['flagEmail'] ;
}    
