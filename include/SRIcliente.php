<?php

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
$param = 'pre39585.xml';
$archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
enviaComprobante($archivo);
function enviaComprobante($param) {
    

try {
$wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";    
} catch (SoapFault $exc) {
    echo $exc->faultstring();
}

$handle = fopen($param, "r");
$po= fread($handle, filesize($param));
fclose($handle);
$client = new SoapClient($wsdl, array('trace' => 1));
try {
    $respuesta = $client -> ValidarComprobante($po);
    $datosXML = $client ->__getLastResponse();
    analizaValidacion($datosXML);
//    var_dump($datosXML);
}
catch (SoapFault $exp) {
print $exp->getMessage();
}
}

function analizaValidacion($param) {
    $doc = new DOMDocument();
    $doc->loadXML($param);
    $checkError = $doc->getElementsByTagName('mensajes')->item(0);
    if ($checkError->hasChildNodes()) {
        include_once 'sri_mensajes_comprobantes.php';
        emiteMensajes($doc);
        parserMensajes();
    } else {
    }
}
