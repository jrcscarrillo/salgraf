<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//$flag = $doc->getElementsByTagName('numeroComprobantes')->item(0)->nodeValue;
//$_SESSION['factura']['fechaAutorizacion'] = $doc->getElementsByTagName('fechaAutorizacion')->item(0)->nodeValue;
//$_SESSION['factura']['codigoMensaje'] = $doc->getElementsByTagName('identificador')->item(0)->nodeValue;
//$_SESSION['factura']['mensaje'] = $doc->getElementsByTagName('mensaje')->item(0)->nodeValue;
//$_SESSION['factura']['mensajeAdicional'] = $doc->getElementsByTagName('informacionAdicional')->item(0)->nodeValue;
//$_SESSION['factura']['TipoError'] = $doc->getElementsByTagName('tipo')->item(0)->nodeValue;
$flag = 1;
$_SESSION['factura']['fechaAutorizacion'] = '2014-09-01';
$_SESSION['factura']['numeroAutorizacion'] = 'No Autorizada';
$_SESSION['factura']['codMsg'] = '35';
$_SESSION['factura']['mensaje'] = 'Firma mal';
$_SESSION['factura']['msgAd'] = 'digest 1';
$_SESSION['factura']['msgError'] = 'error';
grabaFacturaRechazada();
poneFacturaRechazada();

function poneFacturaRechazada() {
    $doc = new DOMDocument();
    $archivo = $_SESSION['archivo'];
    $doc->load($archivo);
    $wk_RefNumber = intval($doc->getElementsByTagName('secuencial')->item(0)->nodeValue);
    
    include_once 'conectaQuickBooks.php';
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE invoice SET CustomField15 = 'RECHAZADA' where RefNumber = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("s", $wk_RefNumber);
    $_SESSION['factura']['flag'] = "No se proceso Actualizacion de la factura seleccionada";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $_SESSION['factura']['flag']  = "*** ERROR No se ha actualizado la factura rechazada " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $_SESSION['factura']['flag']  = 'OK Se Actualizo la factura rechazada ';
    }
//    var_dump($wk_RefNumber . ' flag ' . $nroRegistrosAfectados);
    $stmt->close();
    $db->close();
}

function grabaFacturaRechazada() {
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
    $_SESSION['factura']['estado'] =  'RECHAZADA' ;
    
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
    enviaMailFacturaRechazada();
    
}
function enviaMailFacturaRechazada() {

    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';

    $part = "<div><b>Numero de Factura: </b>" . $_SESSION['factura']['secuencial'] . "<br>";
    $part .= "<b>Numero de Autorizacion: </b" . $_SESSION['factura']['numeroAutorizacion'] . "<br>";
    $part .= "<b>Fecha Emision: </b" . $_SESSION['factura']['fechaEmision'] . "<br>";
    $part .= "<b>Fecha Autorizacion: </b" . $_SESSION['factura']['fechaAutorizacion'] . "<br>";
    $part .= "<b>Razon Social del Comprador</b>" . $_SESSION['factura']['razonSocialComprador'] . "<br>";
    $part .= "<b>Direccion</b>" . $_SESSION['factura']['direccion'] . "<br>";
    $part .= "<b>Valor sin impuestos</b>" . $_SESSION['factura']['totalSinImpuesto'] . "<br>";

    $part .= 'Esta factura rechazada se ha adicionado correctamente';

    $body = "<div><b>Numero de Factura: </b>" . $_SESSION['factura']['secuencial'] . "<br>";
    $body .= "<b>Numero de Autorizacion: </b" . $_SESSION['factura']['numeroAutorizacion'] . "<br>";
    $body .= "<b>Fecha Emision: </b" . $_SESSION['factura']['fechaEmision'] . "<br>";
    $body .= "<b>Fecha Autorizacion: </b" . $_SESSION['factura']['fechaAutorizacion'] . "<br>";
    $body .= "<b>Razon Social del Comprador</b>" . $_SESSION['factura']['razonSocialComprador'] . "<br>";
    $body .= "<b>Direccion</b>" . $_SESSION['factura']['direccion'] . "<br>";
    $body .= "<b>Valor sin impuestos</b>" . $_SESSION['factura']['totalSinImpuesto'] . "<br>";

    $body .= 'Esta factura rechazada se ha adicionado correctamente';
        
    
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $param = 'fact' . $_SESSION['factura']['secuencial'] . '.pdf';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;
    $paraemail['subject'] = 'Factura Rechazada';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
//    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['email'] = 'jrcscarrillo@gmail.com';
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
//    var_dump($paraemail);
    $_SESSION['factura']['flagEmail']  = enviamail($paraemail);
    return $_SESSION['factura']['flagEmail'] ;
}  