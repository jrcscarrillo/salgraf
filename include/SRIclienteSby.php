<?php
session_start();
/*
 * @Author:     Juan Carrillo
 * @Date:       26 de Agosto del 2014
 * @Project:    Comprobantes Electronicos
 */
/*
 * 1.   You can use these web services in testing mode 1 or production mode 2
 * 2.   The first method that i need to use in this web serviceRevisar is "validarComprobante'
 * 3.   After this you will get a response
 * 4.   Parse de XML response and show in the screen
 * 5.   If the response has no errors call the method "autorizacionComprobante"
 * 6.   if the response has errors just show the message error content
 */
$param = 'pre41162.xml';
$archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$args['archivo'] = $archivo;
enviaComprobante($args);
function enviaComprobante($args) {
    
$stringXML = '<?xml version="1.0" encoding="UTF-8"?>';
$stringXML .= '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" ';
$stringXML .= 'xmlns:ns1="http://ec.gob.sri.ws.recepcion"><SOAP-ENV:Body><ns1:validarComprobante>';
$stringXML .= '</ns1:validarComprobante></SOAP-ENV:Body></SOAP-ENV:Envelope>';
file_put_contents('soapRequest.xml', $stringXML);

try {
    if($_SESSION['ambiente'] == 1) {
        $wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";    
    } else {
        $wsdl = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";
    }
    
    } catch (SoapFault $exc) {
    echo $exc->faultstring();
}
$archivo = $args['archivo'];
juntaComprobantes($archivo);
//exit();
//$param = $args['archivo'];
$handle = fopen($param, "r");
$po= fread($handle, filesize($param));
fclose($handle);
$options = array('soap_version'=>SOAP_1_1, 'trace'=>true);    
$client = new SoapClient($wsdl, $options);
$doc = new DOMDocument();
$doc->load("soapRequest.xml");
/*
 * This is the first question:
 * How can I build the SOAP request/
 * I have been trying with a plain text '$po'
 * and then with XML file '$archivo'
 * and finally, with an XML file built with the node <SOAP:Envelope> which is '$doc'
 */
try {
    $respuesta = $client -> ValidarComprobante($archivo);
    echo 'Funciones de este web service';
    var_dump($client ->__getFunctions());
    echo 'Cabeceras de la ultima respuesta';
    var_dump($client ->__getLastResponseHeaders());
    echo 'Ultimo requerimiento';
    var_dump($client ->__getLastRequest());
    $datosXML = $client ->__getLastResponse();
    $args['datosXML'] = $datosXML;
    analizaValidacion($args);
//    var_dump($datosXML);
}
catch (SoapFault $exp) {
print $exp->getMessage();
}
}

function analizaValidacion($args) {
    include_once 'respuestaSRI.php';
    $param = $args['datosXML'];
   
    $doc = new DOMDocument();
    $doc->loadXML($param);
    $checkError = $doc->getElementsByTagName('mensajes')->item(0);
    if ($checkError->hasChildNodes()) {
        $mensaje = $doc->getElementsByTagName('estado')->item(0)->nodeValue;
        if ($mensaje == 'RECIBIDA') {
            revisaAutorizacion($args);
        } else {
            revisaRechazo($arga);
        }
        include_once 'sri_mensajes_comprobantes.php';
        emiteMensajes($doc);
        parserMensajes();
    } else {
        
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