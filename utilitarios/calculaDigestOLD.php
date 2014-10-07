<?php

/*
 * @Author      Juan Carrillo
 * @Date        17 de Septiembre del 2014
 * @Project     Comprobantes Electronicos
 * 
 * 1. En el documento de salida
 * 2. Leo factura
 * 3. Leo Firma
 * 4. Adiciono
 * 5. Calculo digest de InfoFactura
 * 6. Modifico en ds:DigestValue id='DelLote' el nuevo valor del digest
 */
function juntaComprobantes($salida) {
    global $doc1, $doc2, $doc3, $archivo;
    $archivo = $salida;

    $param = "factura.xml";
    $factura = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;    
    $param = "firmaTemplate.xml";
    $signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;

    $doc2 = new DOMDocument();
    $doc2->load($signed);
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($factura);
    juntaLotes( $doc3 );
 
    $doc3->save($archivo);
    }

function juntaLotes( $node )

{
    global $doc1, $doc2, $doc3, $archivo;
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    $doc3->save( $archivo );   
}

function calcularDgst($archivo) {

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