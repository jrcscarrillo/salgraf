<?php

/* 
 * En este programa solo se genera el esqueleto del tag <etsi:SignedProperties>
 */

$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root  = $doc -> createElementNS("http://uri.etsi.org/01903/v1.3.2#", 'etsi:SignedProperties');
$root -> setAttribute('id', 'Salgraf-PropiedadFirma');
$properties = $doc ->createElement('etsi:SignedSignatureProperties');
$o_tiempo = date(DATE_W3C);
$tiempo = $doc ->createElementNS("http://uri.etsi.org/01903/v1.3.2#", "etsi:SigningTime", $o_tiempo);
$certificado = $doc ->createElement('etsi:SigningCertificate');
$cert = $doc ->createElement('etsi:Cert');
$certD = $doc ->createElement('etsi:CertDigest');
$digestM = $doc ->createElement('ds:DigestMethod');
$digestM ->setAttribute('Algorithm', "http://www.w3.org/2000/09/xmldsig#sha1");

/*
 * Calcular el digest value of signed properties abajo
 * Actualizado con el digest de salgraf 29.08.2014
 * 
 */
$o_digestV = "WgIwpCTeMIEAqw5/b8OisIwrQ+I=";
$digestV = $doc ->createElement('ds:DigestValue', $o_digestV); 
$digestV->setAttribute('id', 'digestSigned');
$issuerSerial = $doc ->createElement('etsi:IssuerSerial');

$o_issuerName = "CN = AC BANCO CENTRAL DEL ECUADOR
L = QUITO
OU = ENTIDAD DE CERTIFICACION DE INFORMACION-ECIBCE
O = BANCO CENTRAL DEL ECUADOR
C = EC";
$issuerName = $doc ->createElement('ds:X509IssuerName', $o_issuerName);
//$o_serialNumber = "1313015603"; // este es el digest del certificado juan carrillo
$o_serialNumber = "1313023559"; // este es el digest del certificado de salgraf
$serialNumber = $doc ->createElement('ds:X509SerialNumber', $o_serialNumber);

$signedDataObjectProperties = $doc ->createElement('etsi:SignedDataObjectProperties');
$dataObjectFormat = $doc ->createElement('etsi:DataObjectFormat');
$dataObjectFormat ->setAttribute("ObjectReference", "#Reference-ID-363558");
$o_description = "";
$description = $doc ->createElement('etsi:Description', $o_description);
$mimeType = $doc ->createElement('etsi:MimeType', 'text/xml');

$dataObjectFormat ->appendChild($description);
$dataObjectFormat ->appendChild($mimeType);
$signedDataObjectProperties ->appendChild($dataObjectFormat);

$issuerSerial ->appendChild($serialNumber);
$issuerSerial ->appendChild($issuerName);
$certD ->appendChild($digestM);
$certD ->appendChild($digestV);
$cert ->appendChild($certD);
$cert ->appendChild($issuerSerial);
$certificado ->appendChild($cert);

$properties ->appendChild($tiempo);
$properties ->appendChild($certificado);
$root ->appendChild($properties);

$doc -> appendChild($root);
/*
 * Poner en $param el tipo de comprobante que se esta firmando
 */
$param = "signedTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();