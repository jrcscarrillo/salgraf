<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$param = "signedTemplate.xml";
$signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$param = "qualifyingTemplate.xml";
$firma = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;

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
    global $doc2, $doc3;
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
 $param = "qualifyingTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc3->save( $salida );   
}

