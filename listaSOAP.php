<?php

/* 
 * listar los metodos disponibles en el servidor del SRI.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
$wsdl = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";    
} catch (SoapFault $exc) {
    echo $exc->faultstring();
}

$client = new SoapClient($wsdl);
var_dump($client->__getTypes());
 