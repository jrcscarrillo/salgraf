<?php
session_start();
/*
 * @Author:     Juan Carrillo
 * @Date:       26 de Agosto del 2014
 * @Project:    Comprobantes Electronicos
 */
/*
 * 1.   Dependiendo del ambiente utilizar los 'web services' de prueba o de produccion
 * 2.   Revisar que el archivo que se procesa no ha sido procesado
 * 3.   Utilizar el 'web service' de validacion de comprobante
 * 4.   Recibir la respuesta en XML
 * 5.   Parse el documento y emitir el informe por pantalla
 * 6.   Si no tiene errores ejecutar el 'web service' de respuesta autorizacion del lote o del comprobante
 * 7.   Recibir la respuesta en XML
 * 8.   Parse el documento y generar los datos de autorizacion en la base de datos
 * 9.   Enviar los correos electronicos  a los clientes
 */
$param = 'vaya41136.xml';
$archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$_SESSION['archivo'] = $archivo;

$doc = new DOMDocument();
$doc->load($archivo);
$content = $doc->saveXML(); // <-- exclusive, with comments

$actualDigest = base64_encode($content);

$_SESSION['XML'] = $actualDigest;

enviaComprobante();

function enviaComprobante() {

try {
    if($_SESSION['ambiente'] == 1) {
        $wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";    
    } else {
        $wsdl = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";
    }
    
    } catch (SoapFault $exc) {
    echo $exc->faultstring();
}

$options = array('soap_version'=>SOAP_1_1, 'trace'=>true);    
$client = new SoapClient($wsdl, $options);

try {
    $respuesta = $client -> ValidarComprobante(array('xml'=>$_SESSION['XML']));

//    echo 'Ultimo requerimiento';
//    var_dump($client ->__getLastRequest());
    $datosXML = $client ->__getLastResponse();
    $_SESSION['datosXML'] = $datosXML;
    analizaValidacion();
//    var_dump($datosXML);
}
catch (SoapFault $exp) {
print $exp->getMessage();
}
}

function analizaValidacion() {
    include_once 'respuestaSRI.php';
    $param = $_SESSION['datosXML'];
   
    $doc = new DOMDocument();
    $doc->loadXML($param);
    $checkError = $doc->getElementsByTagName('mensajes')->item(0);
    if ($checkError->hasChildNodes()) {
        $mensaje = $doc->getElementsByTagName('estado')->item(0)->nodeValue;
        if ($mensaje == 'RECIBIDA') {
            revisaAutorizacion($doc);
            pieDeAutorizacion();
        } else {
            include_once 'sri_mensajes_rechazada.php';
            revisaRechazo($doc);
            pieDeRechazo();
        }
//        include_once 'sri_mensajes_comprobantes.php';
//        emiteMensajes($doc);
//        parserMensajes();
    }
}

function juntaComprobantes($archivo) {
    $archivoSoap = "soapRequest.xml";
    
    $doc2 = new DOMDocument();
    $doc2->load($archivo);
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($archivoSoap);
    $factura = $doc2->getElementsByTagName('factura')->item(0);
    $importar = $doc3->importNode($factura, TRUE);
    $soapNodo = $doc3->getElementsByTagName('validarComprobante')->item(0);
    $soapNodo->appendChild($importar);
    $doc3->save($archivoSoap);
    }

?>  