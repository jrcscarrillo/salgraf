<?php

$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$qualifyingProperties = $doc -> createElementNS("http://uri.etsi.org/01903/v1.3.2#",  'etsi:QualifyingProperties');
$qualifyingProperties ->setAttribute("Target", "#refQualifyingProperties");
$qualifyingProperties -> setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');

$doc ->appendChild($qualifyingProperties);
/*
 * Poner en $param el tipo de comprobante que se esta firmando
 */
$param = "qualifyingTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();