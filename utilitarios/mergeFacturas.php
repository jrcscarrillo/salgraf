<?php

function juntaFacturas() {
    global $doc1, $doc2, $doc3, $firma;
    $param = "detalles.xml";
    $key = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
    $param = "factura.xml";
    $signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
    $param = "comprobante.xml";
    $firma = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
 
    $doc1 = new DOMDocument();
    $doc1->load($key);
    $doc2 = new DOMDocument();
    $doc2->load($signed);
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($firma);
    traverseLote( $doc3 );
//    exit();
}

/*
 * 1. Creo el documento resultado
 * 2. Leo detalles
 * 3. Adiciono
 * 4. Leo factura
 * 5. Adiciono
 * 
 */

function traverseLote( $node )

{
    global $doc1, $doc2, $doc3, $firma;
    $getKey = $doc1->documentElement;
    $getNuevo = $doc2 ->importNode($getKey, true);
    $doc2 ->documentElement -> appendChild( $getNuevo );
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    $doc3->save( $firma );   
}

