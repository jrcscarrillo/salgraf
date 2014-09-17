<?php

/* 
 * Para utilizar estas opciones los parametros son pasados en una
 * array associative
 * $args['archivo'] el nombre del archivo XML que contiene la factura en proceso
 */

/*
 * En este programa se controla el uso de los webservices de prueba o produccion
 * Si la respuesta recibida es autorizada entonces
 * Autorizada.1. Generar un registtro en la base de datos de los comprobantes electronicos en la 
 *               tabla de los documentos autorizados con el estado "AUTORIZADA"
 * Autorizada.2. Moficar la base de datos sincronizada en el campo CustomField15 con "AUTORIZADA"
 * Autorizada.3. Enviar el e-mail al cliente
 * Autorizada.4. Modificar la tabla de los documentos autorizados con el estado "INFORMADA"
 */

function revisaAutorizacion($args) {
    $doc = new DOMDocument();
    $archivo = $args['archivo'];
    $doc->load($archivo);
    $claveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
    $args['claveAcceso'] = $claveAcceso;
try {
    if($_SESSION['ambiente'] == 1){
        $wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";    
    } else {
        $wsdl = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";    
        }
    } catch (SoapFault $exc) {
    echo $exc->faultstring();
}

$po= $claveAcceso;

$client = new SoapClient($wsdl, array('trace' => 1));
try {
    $respuesta = $client -> autorizacionComprobante($po);
    $datosXML = $client ->__getLastResponse();
    $args['datosxml'] = $datosXML;
    analizaAutorizacion($args);
//    var_dump($datosXML);
}
catch (SoapFault $exp) {
print $exp->getMessage();
}
}
/*
 * Esta funcion revisa que la respuesta del webservice sea autorizada o no
 */
function analizaAutorizacion($args) {
    $doc = new DOMDocument();
    $param = $args['datosxml'];
    $doc->loadXML($param);
    $siTieneAutorizacion = FALSE;
    $siTieneAutorizacion = buscaAutorizacion($doc);
    if ($siTieneAutorizacion) {
        procesaAutorizado($args);
    } else {
        procesaRechazado($args);
    }
}

function procesaAutorizado($args) {
    $doc = new DOMDocument();
    $param = $args['datosxml'];
    $doc->loadXML($param);
    $nroAutorizacionNodo = $doc->getElementsByTagName('numeroAutorizacion')->item(0);
    $nroAutorizacion = $nroAutorizacionNodo->nodeValue;
    $fecAutorizacionNodo = $doc->getElementsByTagName('fechaAutorizacion')->item(0);
    $fecAutorizacion = $fecAutorizacionNodo->nodeValue;
    $args['numeroAutorizacion'] = $nroAutorizacion;
    $args['fechaAutorizacion'] = $fecAutorizacion;
    grabaFacturaAutorizada($args);
    poneFacturaAutorizada($args);
}

function poneFacturaAutorizada($args) {
    $doc = new DOMDocument();
    $archivo = $args['archivo'];
    $doc->load($archivo);
    $wk_RefNumber = $doc->getElementsByTagName('secuencial');
    include_once 'conectaQuickBooks.php';
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE invoice SET CustomField15 = 'AUTORIZADA' where RefNumber = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("s", $wk_RefNumber);
    $flag = "No se proceso Actualizacion de la factura seleccionada";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $flag = "*** ERROR No se ha actualizado la factura autorizada " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $flag = 'OK Se Actualizo la factura autorizada';
    }
        /* close statement */
    $stmt->close();
    $db->close();
}

function grabaFacturaAutorizada($args) {
    include_once 'conexionDB.php';
    $doc = new DOMDocument();
    $archivo = $args['archivo'];
    $doc->load($archivo);
    $wk_Ambiente = $doc->getElementsByTagName('ambiente')->item(0)->nodeValue;
    $wk_TipoEmision = $doc->getElementsByTagName('tipoEmision')->item(0)->nodeValue;
    $wk_Ruc = $doc->getElementsByTagName('ruc')->item(0)->nodeValue;
    $wk_ClaveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
    $wk_Estab = $doc->getElementsByTagName('estab')->item(0)->nodeValue;
    $wk_Punto = $doc->getElementsByTagName('ptoEmi')->item(0)->nodeValue;
    $wk_CodDoc = $doc->getElementsByTagName('codDoc')->item(0)->nodeValue;
    $wk_Sq = $doc->getElementsByTagName('secuencial')->item(0)->nodeValue;
    $wk_FechaEmision = $doc->getElementsByTagName('fechaEmision')->item(0)->nodeValue;
    $wk_TipoId = $doc->getElementsByTagName('tipoIdentificacion')->item(0)->nodeValue;
    $wk_NroId = $doc->getElementsByTagName('identificacionComprador')->item(0)->nodeValue;
    $wk_RazonComprador = $doc->getElementsByTagName('razonSocialComprador')->item(0)->nodeValue;
    $wk_TotalImpto = $doc->getElementsByTagName('totalSinImpuesto')->item(0)->nodeValue;
    $wk_Propina = $doc->getElementsByTagName('propina')->item(0)->nodeValue;
    $wk_ImporteTotal = $doc->getElementsByTagName('importeTotal')->item(0)->nodeValue;
    $wk_TotalImpto = $wk_ImporteTotal - $wk_TotalImpto;
    $wk_Moneda = 'DOLAR' ;
    $wk_Estado = 'AUTORIZADA' ;
    $wk_CodMsg = '' ;
    $wk_Mensaje = '' ;
    $wk_MsgAdicional = '' ;
    $wk_TipoError = '' ;
    $wk_FechaAutoriza = $args['fechaAutorizacion'] ;
    $wk_NumeroAutoriza = $args['numeroAutorizacion'] ;
    
    $db = conecta_DB();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $today = date("Y-m-d H:i:s");
    $sql = "insert into facturas(FacturasAmbiente, FacturasTipoEmision, FacturasRuc, FacturasClaveAcceso, FacturasEstab, FacturasCodDoc, FacturasPunto, FacturasSq, FacturasFechaEmision, FacturasTipoId, ";
    $sql .= "FacturasNroId, FacturasGuia, FacturasRazonComprador, FacturasTotalImpto, FacturasMoneda, FacturasEstado, FacturasFechaAutoriza, FacturasNumeroAutoriza, FacturasCodMsg, FacturasMensaje, FacturasMsgAdicional, FacturasTipoError";
    $sql .= ") values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ssssssssssssssssssssssss", $wk_Ambiente, $wk_TipoEmision, $wk_Ruc, $wk_ClaveAcceso, $wk_Estab, $wk_CodDoc, $wk_Punto, $wk_Sq, $wk_FechaEmision, $wk_NumeroAutoriza, $wk_TipoId, $wk_NroId, $wk_Guia, $wk_RazonComprador, $wk_TotalImpto, $wk_Propina, $wk_ImporteTotal, $wk_Moneda, $wk_Estado, $wk_FechaAutoriza, $wk_CodMsg, $wk_Mensaje, $wk_MsgAdicional, $wk_TipoError);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    echo 'Factura Autorizada Registrada ' . $wk_Sq;
    
}

function procesaRechazado($args) {
    $doc = new DOMDocument();
    $param = $args['datosxml'];
    $doc->loadXML($param);
    $siTieneMensajes = FALSE;
    $siTieneMensajes = buscaRechazado($doc);
    if ($siTieneMensajes) {
        $flag = $doc->getElementsByTagName('numeroComprobantes')->item(0)->nodeValue;
        if ($flag > 0){
            $fecAutorizacionNodo = $doc->getElementsByTagName('fechaAutorizacion')->item(0);
            $fecAutorizacion = $fecAutorizacionNodo->nodeValue;
            $args['fechaAutorizacion'] = $fecAutorizacion;
            $args['codigoMensaje'] = $doc->getElementsByTagName('identificador')->item(0)->nodeValue ;
            $args['mensaje'] = $doc->getElementsByTagName('mensaje')->item(0)->nodeValue;
            $args['mensajeAdicional'] = $doc->getElementsByTagName('informacionAdicional')->item(0)->nodeValue;
            $args['TipoError'] = $doc->getElementsByTagName('tipo')->item(0)->nodeValue;
            grabaFacturaRechazada($args);
            poneFacturaRechazada($args);
        } else {
            echo '*** ERROR GRAVE *** Reintente mas tarde o no tiene habilitado el ambiente de pruebas o produccion';
        }
    } else {
        var_dump($args);
        echo '*** ERROR GRAVE *** Comunicarse con el desarrollador';
    }
}

function poneFacturaRechazada($args) {
    $doc = new DOMDocument();
    $archivo = $args['archivo'];
    $doc->load($archivo);
    $wk_RefNumber = $doc->getElementsByTagName('secuencial');
    include_once 'conectaQuickBooks.php';
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE invoice SET CustomField15 = 'RECHAZADA' where RefNumber = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("s", $wk_RefNumber);
    $flag = "No se proceso Actualizacion de la factura seleccionada";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $flag = "*** ERROR No se ha actualizado la factura autorizada " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $flag = 'OK Se Actualizo la factura autorizada';
    }
        /* close statement */
    $stmt->close();
    $db->close();
}

function grabaFacturaRechazada($args) {
    include_once 'conexionDB.php';
    $doc = new DOMDocument();
    $archivo = $args['archivo'];
    $doc->load($archivo);
    $wk_Ambiente = $doc->getElementsByTagName('ambiente')->item(0)->nodeValue;
    $wk_TipoEmision = $doc->getElementsByTagName('tipoEmision')->item(0)->nodeValue;
    $wk_Ruc = $doc->getElementsByTagName('ruc')->item(0)->nodeValue;
    $wk_ClaveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
    $wk_Estab = $doc->getElementsByTagName('estab')->item(0)->nodeValue;
    $wk_Punto = $doc->getElementsByTagName('ptoEmi')->item(0)->nodeValue;
    $wk_CodDoc = $doc->getElementsByTagName('codDoc')->item(0)->nodeValue;
    $wk_Sq = $doc->getElementsByTagName('secuencial')->item(0)->nodeValue;
    $wk_FechaEmision = $doc->getElementsByTagName('fechaEmision')->item(0)->nodeValue;
    $wk_TipoId = $doc->getElementsByTagName('tipoIdentificacion')->item(0)->nodeValue;
    $wk_NroId = $doc->getElementsByTagName('identificacionComprador')->item(0)->nodeValue;
    $wk_RazonComprador = $doc->getElementsByTagName('razonSocialComprador')->item(0)->nodeValue;
    $wk_TotalImpto = $doc->getElementsByTagName('totalSinImpuesto')->item(0)->nodeValue;
    $wk_Propina = $doc->getElementsByTagName('propina')->item(0)->nodeValue;
    $wk_ImporteTotal = $doc->getElementsByTagName('importeTotal')->item(0)->nodeValue;
    $wk_TotalImpto = $wk_ImporteTotal - $wk_TotalImpto;
    $wk_Moneda = 'DOLAR' ;
    $wk_Estado = 'RECHAZADA' ;
    $wk_CodMsg = $args['codigoMensaje'];
    $wk_Mensaje = $args['mensaje'];
    $wk_MsgAdicional = $args['mensajeAdicional'];
    $wk_TipoError = $args['tipoError'];
    $wk_FechaAutoriza = $args['fechaAutorizacion'] ;
    $wk_NumeroAutoriza = 0;
    
    $db = conecta_DB();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $today = date("Y-m-d H:i:s");
    $sql = "insert into facturas(FacturasAmbiente, FacturasTipoEmision, FacturasRuc, FacturasClaveAcceso, FacturasEstab, FacturasCodDoc, FacturasPunto, FacturasSq, FacturasFechaEmision, FacturasTipoId, ";
    $sql .= "FacturasNroId, FacturasGuia, FacturasRazonComprador, FacturasTotalImpto, FacturasMoneda, FacturasEstado, FacturasFechaAutoriza, FacturasNumeroAutoriza, FacturasCodMsg, FacturasMensaje, FacturasMsgAdicional, FacturasTipoError";
    $sql .= ") values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ssssssssssssssssssssssss", $wk_Ambiente, $wk_TipoEmision, $wk_Ruc, $wk_ClaveAcceso, $wk_Estab, $wk_CodDoc, $wk_Punto, $wk_Sq, $wk_FechaEmision, $wk_NumeroAutoriza, $wk_TipoId, $wk_NroId, $wk_Guia, $wk_RazonComprador, $wk_TotalImpto, $wk_Propina, $wk_ImporteTotal, $wk_Moneda, $wk_Estado, $wk_FechaAutoriza, $wk_CodMsg, $wk_Mensaje, $wk_MsgAdicional, $wk_TipoError);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    echo 'Factura Autorizada Registrada ' . $wk_Sq;
    
}

function buscaAutorizacion( $node )
{
    switch ( $node->nodeType )
    {
        case XML_ELEMENT_NODE:
            if ($node->tagName == "numeroAutorizacion") {
                $flag = 'SI';
            }
            break;
        case XML_TEXT_NODE:
            if ($node->parentNode->tagName == 'numeroAutorizacion') {
                return TRUE;
            }
            break;
    }
    if ( $node->hasChildNodes() ) {
        foreach ( $node->childNodes as $child ) {
            buscaAutorizacion( $child );
        }
    }
}

function buscaRechazado( $node )
{
    switch ( $node->nodeType )
    {
        case XML_ELEMENT_NODE:
            if ($node->tagName == "numeroComprobantes") {
                $flag = 'SI';
            }
            break;
        case XML_TEXT_NODE:
            if ($node->parentNode->tagName == 'numeroComprobantes') {
                return TRUE;
            }
            break;
    }
    if ( $node->hasChildNodes() ) {
        foreach ( $node->childNodes as $child ) {
            buscaRechazado( $child );
        }
    }
}