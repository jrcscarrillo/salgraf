<?php

/*
 * @Author      Juan Carrillo
 * @Date        3 de octubre del 2014
 * @Project     Comprobantes Electronicos
 * 
 * 1. En el documento de salida
 * 2. Leo factura
 * 3. Leo Firma
 * 4. Adiciono
 * 5. Calculo digest de todo el archivo
 * 6. condicion hasta ver funcionamiento despues eliminar y poner todo en el nodeSignature
 */

    $param = "probando.xml";
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param; 
juntaComprobantes($salida);
calcularDgst($salida);
function juntaComprobantes($salida) {
    global $doc1, $doc2, $doc3, $archivo;
    $archivo = $salida;

    $param = "factura.xml";
    $factura = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;    
//    $param = "nodoSignature.xml";
//    $signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/' . $param;
    $param = 'desdeejemplo.xml';
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
    $clave = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/josegabriel.pem';    
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($archivo);
    
    $nodoCertificado = $doc3
        ->getElementsByTagName('X509Certificate')
        ->item(0);
    $nodoKeyInfo = $doc3
            ->getElementsByTagName('KeyInfo')
            ->item(0);
    $nodoSignedProperties = $doc3
            ->getElementsByTagName('SignedProperties')
            ->item(0);
    $nodoDocumento = $doc3
            ->getElementsByTagName('factura')
            ->item(0);
    $content = $nodoCertificado->C14N(TRUE, TRUE); // <-- exclusive, with comments

    $actualDigest = base64_encode(hash('SHA1', $content, true));
  
    $fp = fopen($clave, "r");
    $priv_key = fread($fp, 8192);
    fclose($fp);
    $passphrase = 'salgraf';
    $res = openssl_get_privatekey($priv_key,$passphrase);
    openssl_private_encrypt($actualDigest, $crypttext, $res);
    $firmaEncriptadaBase64 = base64_encode($crypttext);
    
    /*
     * PRIMER PASO calcular el digest del certificado
     */
    $digestDelCertificado = $doc3->getElementsByTagName('DigestValue')->item(3);
    $digestDelCertificado->nodeValue = $actualDigest;
    /*
     * SEGUNDO PASO obtener la fecha actual aqui esta el ejemplo
     * esto debera ponerse cuando se generan los documentos que se firmen
     */
    $o_tiempo = date(DATE_W3C);
    $fechaFirma = $doc3->getElementsByTagName('SigningTime')->item(0);
    $fechaFirma->nodeValue = $o_tiempo;
    /*
     * TERCER PASO se calcula con openssl_private_encrypt
     * el valor de la firma encriptado con la llave privada
     */
    $firmaEncriptada = $doc3->getElementsByTagName('SignatureValue')->item(0);
//    $firmaEncriptada->nodeValue = $firmaEncriptadaBase64;
    /*
     * CUARTO PASO calcular el digest del nod keyinfo
     */

    $content = $nodoKeyInfo->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $digestDelKeyinfo = $doc3->getElementsByTagName('DigestValue')->item(1);
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    $digestDelKeyinfo->nodeValue = $actualDigest;
    /*
     * QUINTO PASO calcular el digest del nodo signedproperties
     */

    $content = $nodoSignedProperties->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $digestDelSignedProperties = $doc3->getElementsByTagName('DigestValue')->item(0);
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    $digestDelSignedProperties->nodeValue = $actualDigest;
    /*
     * SEXTO PASO calcular el digest del nodo factura
     */
    $content = $nodoDocumento->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $digestDelDocumento = $doc3->getElementsByTagName('DigestValue')->item(2);
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    $digestDelDocumento->nodeValue = $actualDigest;
    $doc3->save($archivo);
}