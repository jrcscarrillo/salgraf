<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$param = "keyInfoTemplate.xml";
$key = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$param = "objectTemplate.xml";
$signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$param = "firmaTemplate.xml";
$firma = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;

/*
 * 1. Creo el documento resultado
 * 2. Leo signedProperties
 * 3. Calculo digest y adiciono
 * 4. Leo keyInfor
 * 5. Calculo digest y adiciono
 * 6. Leo firma
 * 7. Modifico digest value y salvo 
 */

$doc1 = new DOMDocument();
$doc1->load($key);
$doc2 = new DOMDocument();
$doc2->load($signed);
$doc3 = new DOMDocument();
$doc3->formatOutput = TRUE;
$doc3->load($firma);
// Traverse the document
traverseLote( $doc3 );
exit();
/*
  Traverses each node of the DOM document recursively
*/

function traverseLote( $node )

{
    global $doc, $doc1, $doc2, $doc3;
    $getKey = $doc1->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    
 $param = "firmaFirma.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc3->save( $salida );   
}

