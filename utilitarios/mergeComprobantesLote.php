<?php

/*
 * @Author      Juan Carrillo
 * @Date        28 de Agosto del 2014
 * @Project     Comprobantes Electronicos
 * 
 * 1. En el documento de salida
 * 2. Leo comprobantes
 * 3. Leo Firma
 * 4. Adiciono
 * 5. Calculo digest del comprobante
 * 6. Modifico en ds:DigestValue id='DelLote' el nuevo valor del digest
 */

function juntaComprobantes() {
    global $doc1, $doc2, $doc3, $salida;
    $param = "comprobante.xml";
    $comprobante = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
    $param = "loteMasivo.xml";
    $loteMasivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;    
    $param = "firmaFirma.xml";
    $signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    $param = $_POST['archivo'] . '.xml';
//    $param = 'Juancho.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
 
    $doc1 = new DOMDocument();
    $doc1->load($comprobante);
    $doc2 = new DOMDocument();
    $doc2->load($signed);
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($loteMasivo);
    juntaLotes( $doc3 );
    $xmlDoc = $doc1->C14N();
    $digest = base64_encode(pack("H*", sha1( $xmlDoc )));
    $losDigest = $doc3->getElementsByTagName('DigestValue');
    foreach ($losDigest as $key) {
        
        if ($key->hasAttributes()){
            if ($key->getAttribute('id') == 'DelLote') {
                echo 'tiene esto de valor ' . $key->nodeValue . '<br>';
                $key->nodeValue = $digest;
            }
        }
    }
    $doc3->save($salida);
//    exit();
}

function juntaLotes( $node )

{
    global $doc1, $doc2, $doc3, $salida;
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    $doc3->save( $salida );   
}

