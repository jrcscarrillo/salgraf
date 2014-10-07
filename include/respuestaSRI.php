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

function revisaAutorizacion() {
    $doc = new DOMDocument();
    $archivo = $_SESSION['archivo'];
    $doc->load($archivo);
    $claveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
    $_SESSION['claveAcceso'] = $claveAcceso;
try {
    if($_SESSION['ambiente'] == 1){
        $wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";    
    } else {
        $wsdl = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";    
        }
    } catch (SoapFault $exc) {
    echo $exc->faultstring();
}

$options = array('soap_version'=>SOAP_1_1, 'trace'=>true);    
$client = new SoapClient($wsdl, $options);

try {
    $respuesta = $client -> autorizacionComprobante(array('claveAccesoComprobante'=>$args['claveAcceso']));
    $datosXML = $client ->__getLastResponse();
    $_SESSION['datosxml'] = $datosXML;
    analizaAutorizacion();
//    var_dump($datosXML);
}
catch (SoapFault $exp) {
print $exp->getMessage();
}
}
/*
 * Esta funcion revisa que la respuesta del webservice sea autorizada o no
 */
function analizaAutorizacion() {
    $doc = new DOMDocument();
    $param = $_SESSION['datosxml'];
    $doc->loadXML($param);
    $siTieneAutorizacion = FALSE;
    $siTieneAutorizacion = buscaAutorizacion($doc);
    if ($siTieneAutorizacion) {
        procesaAutorizado();
    } else {
        procesaRechazado();
    }
}

function procesaAutorizado() {
    $doc = new DOMDocument();
    $param = $_SESSION['datosxml'];
    $doc->loadXML($param);
    $nroAutorizacionNodo = $doc->getElementsByTagName('numeroAutorizacion')->item(0);
    $nroAutorizacion = $nroAutorizacionNodo->nodeValue;
    $fecAutorizacionNodo = $doc->getElementsByTagName('fechaAutorizacion')->item(0);
    $fecAutorizacion = $fecAutorizacionNodo->nodeValue;
    $_SESSION['factura']['numeroAutorizacion'] = $nroAutorizacion;
    $_SESSION['factura']['fechaAutorizacion'] = $fecAutorizacion;
    include_once 'facturaAutorizada.php';
    grabaFacturaAutorizada();
    poneFacturaAutorizada();
}

function procesaRechazado() {
    include_once 'facturaRechazada.php';
    $doc = new DOMDocument();
    $param = $_SESSION['datosxml'];
    $doc->loadXML($param);
    $siTieneMensajes = FALSE;
    $siTieneMensajes = buscaRechazado($doc);
    if ($siTieneMensajes) {
        $flag = $doc->getElementsByTagName('numeroComprobantes')->item(0)->nodeValue;
        if ($flag > 0){
            $_SESSION['factura']['fechaAutorizacion'] = $doc->getElementsByTagName('fechaAutorizacion')->item(0)->nodeValue;
            $_SESSION['factura']['codigoMensaje'] = $doc->getElementsByTagName('identificador')->item(0)->nodeValue ;
            $_SESSION['factura']['mensaje'] = $doc->getElementsByTagName('mensaje')->item(0)->nodeValue;
            $_SESSION['factura']['mensajeAdicional'] = $doc->getElementsByTagName('informacionAdicional')->item(0)->nodeValue;
            $_SESSION['factura']['TipoError'] = $doc->getElementsByTagName('tipo')->item(0)->nodeValue;
            grabaFacturaRechazada();
            poneFacturaRechazada();
        } else {
            echo '*** ERROR GRAVE *** Reintente mas tarde o no tiene habilitado el ambiente de pruebas o produccion';
        }
    } else {
        echo '*** ERROR GRAVE *** Comunicarse con el desarrollador';
    }
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