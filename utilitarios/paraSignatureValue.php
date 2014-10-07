<?php
juntaComprobantes();
function juntaComprobantes() {
    $param = "desdeejemplo.xml";
    $factura = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;    
    $archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/' . $param;    
    $clave = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/josegabriel.pem';    
    $doc3 = new DOMDocument();
    $doc3->formatOutput = TRUE;
    $doc3->load($factura);
    $doc3->save($archivo);
    $nodoCertificado = $doc3
        ->getElementsByTagName('X509Certificate')
        ->item(0);
    $nodoKeyInfo = $doc3
            ->getElementsByTagName('KeyInfo')
            ->item(0);
    $nodoSignedProperties = $doc3
            ->getElementsByTagName('SignedProperties')
            ->item(0);
    
$fp=fopen($clave,"r"); 
$priv_key=fread($fp,8192); 
fclose($fp); 
$passphrase = 'salgraf';
// $passphrase is required if your key is encoded (suggested) 
$res = openssl_get_privatekey($priv_key,$passphrase); 
/* 
* NOTE:  Here you use the returned resource value 
*/ 
//openssl_private_encrypt($actualDigest, $crypttext, $res); 
//echo "String crypted: $crypttext" . "<br>" . "<br>"; 
//$firmaEncriptadaBase64 = base64_encode($crypttext);
//echo 'Debe ser igual => ' . $firmaEncriptadaBase64 . "<br>" . "<br>";

//echo 'Clave privada => ';
var_dump($res);
//echo "<br>" . "<br>";
/*
 * Recupera el valor del certificado y lo guarda 
 * falta saber como elimiar el BEGIN y END
 * pero aqui esta la opcion para la segunda version
 * por el momento recuperar uno de los certificados con openssl
$cert = openssl_x509_export($priv_key, $certificado, TRUE); 
$nodoCertificado->nodeValue = $certificado;
if ($cert) {
    echo 'Certificado => ' . $certificado . "<br>" . "<br>";
} else {
    echo 'No acceso al acertificado' . "<br>" . "<br>";
}
 * 
 */
/*
 * PRIMER PASO calcular el digest del certificado
 */
    $content = $nodoCertificado->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    echo 'calculando con base64 => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = openssl_digest($content, 'sha1', FALSE);
    echo 'calculando con openssl => ' . $actualDigest . '<br>' . "<br>";
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
//$firmaEncriptada = $doc3->getElementsByTagName('SignatureValue')->item(0);
//$firmaEncriptada->nodeValue = $firmaEncriptadaBase64;
/*
 * CUARTO PASO calcular el digest del nod keyinfo
 */
    
    $content = $nodoKeyInfo->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $digestDelKeyinfo = $doc3->getElementsByTagName('DigestValue')->item(1);
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    $digestDelKeyinfo->nodeValue = $actualDigest;
    echo 'Calculado del nodo KeyInfo => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = openssl_digest($content, 'sha1', FALSE);
    echo 'calculando con openssl KeyInfo => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = base64_encode($content);
    echo 'calculando con base64 KeyInfo => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = openssl_digest($actualDigest, 'sha1', FALSE); 
    echo 'calculando con base64 i openssl_digest KeyInfo => ' . $actualDigest . '<br>' . "<br>";
 /*
 * QUINTO PASO calcular el digest del nodo signedproperties
 */
    
    $content = $nodoSignedProperties->C14N(TRUE, TRUE); // <-- exclusive, with comments
    $digestDelSignedProperties = $doc3->getElementsByTagName('DigestValue')->item(0);
    $actualDigest = base64_encode(hash('SHA1', $content, true));
    $digestDelSignedProperties->nodeValue = $actualDigest;
    echo 'Calculado del nodo SignedProperties => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = openssl_digest($content, 'sha1', FALSE);
    echo 'calculando con openssl SignedProperties => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = base64_encode($content);
    echo 'calculando con base64 SignedProperties => ' . $actualDigest . '<br>' . "<br>";
    $actualDigest = openssl_digest($actualDigest, 'sha1', FALSE); 
    echo 'calculando con base64 i openssl_digest SignedProperties => ' . $actualDigest . '<br>' . "<br>";
$doc3->save($archivo);
}