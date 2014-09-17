<?php

/*
 * @Author      Juan Carrillo
 * @Date        28 de Agosto del 2014
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
function juntaComprobantesOLD($salida) {
    global $doc1, $doc2, $doc3, $archivo;
    $archivo = $salida;
    $param = "InfoFactura.xml";
    $infoFactura= $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
    $param = "factura.xml";
    $factura = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;    
    $param = "firmaFirma.xml";
    $signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    $doc1 = new DOMDocument();
    $doc1->load($infoFactura);
    $doc2 = new DOMDocument();
    $doc2->load($signed);
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($factura);
    juntaLotes( $doc3 );
    $xmlDoc = $doc1->C14N();
    $digest = base64_encode(pack("H*", sha1( $xmlDoc )));
    $losDigest = $doc3->getElementsByTagName('DigestValue');
    foreach ($losDigest as $key) {
        
        if ($key->hasAttributes()){
            if ($key->getAttribute('id') == 'DelLote') {
//                echo 'tiene esto de valor ' . $key->nodeValue . '<br>';
                $key->nodeValue = $digest;
            }
        }
    }
    $doc3->save($archivo);
//    exit();
}

function juntaLotes( $node )

{
    global $doc1, $doc2, $doc3, $archivo;
    $getKey = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getKey, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );
    $doc3->save( $archivo );   
}

