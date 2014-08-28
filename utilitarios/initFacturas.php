<?php

function inicializaC() {
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('comprobantes');
    $doc->appendChild($root);
    $doc->save('comprobante.xml');
}

function inicializaF() {

    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('comprobante');
    $factura = $doc->createElement('factura');
    $root->appendChild($factura);
    $doc->appendChild($root);
    $doc->save('factura.xml');
}

function inicializaD() {

    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('detalles');
    $doc->appendChild($root);
    $doc->save('detalles.xml');
}