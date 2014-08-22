<?php

$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$object = $doc -> createElementNS("http://www.w3.org/2000/09/xmldsig#", 'ds:Object');

$doc ->appendChild($object);
/*
 * Poner en $param el tipo de comprobante que se esta firmando
 */
$param = "objectTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();