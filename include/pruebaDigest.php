<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
calcularDgst('');
function calcularDgst($param) {
    $param = 'vaya41057.xml';
    $archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    $doc = new DOMDocument();
    $doc->load($archivo);
    testCreateDigest($doc, $archivo);
    digestOneWay($doc); 
}



function testCreateDigest(DOMDocument $doc, $archivo) {

    $ns = $doc->documentElement->tagName;
    $body = $doc
        ->getElementsByTagName('SignedProperties')
        ->item(0);

    $content = $body->C14N(TRUE, TRUE); // <-- exclusive, with comments

    $actualDigest = base64_encode(hash('SHA1', $content, true));

    echo 'nueva forma de calcular (signedproperties) => ' . $actualDigest . '<br>';

    $digest0 = $doc->getElementsByTagName('DigestValue')->item(0);
    
    $valorDigest = $doc->createTextNode($actualDigest);
    
    $digest0->appendChild($valorDigest);
    
    $body = $doc
        ->getElementsByTagName('Keyinfo')
        ->item(0);

    $content = $body->C14N(TRUE, TRUE); // <-- exclusive, with comments

    $actualDigest = base64_encode(hash('SHA1', $content, true));

    echo 'nueva forma de calcular (Keyinfo) => ' . $actualDigest . '<br>';

    $digest1 = $doc->getElementsByTagName('DigestValue')->item(1);
    
    $valorDigest = $doc->createTextNode($actualDigest);
    
    $digest1->appendChild($valorDigest);
    
    $doc->save($archivo);
}
function digestOneWay($doc) {
    
$xpath = new DOMXPath($doc);
$signed = $doc->getElementsByTagName('SignedProperties');
foreach ($doc->getElementsByTagName('SignedProperties') as $node) {
    $nodo = $node->getNodePath() . "\n";
    $digest1 = $node->C14N(true, true);
    echo 'Nodo canonalizado => ' . $digest1 . '<br>';
//    $digestvalue = base64_encode(pack("H*", sha1( $digest1 )))V;
      $digestvalue = base64_encode(hash('SHA1', $digest1, true));
    echo 'Valor calculado del digest => ' . $digestvalue . '<br>';
    echo $digestvalue;
}
}