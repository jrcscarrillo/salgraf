<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$param = "firmaTemplate.xml";
$firma = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$loteFactura = "facturaJuan.xml";
$factura = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $loteFactura;
$loteMasivoTemplate = "loteMasivoTemplate.xml";
$lote = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $loteMasivoTemplate;
$merged = "signed.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $merged;

/*
 * 1. Creo el documento resultado
 * 2. Leo lotes y adiciono
 * 3. Leo el template de firma y adiciono
 * 4. Salvo el archivo
 * 5. Abro el archivo
 * 6. Calculo digest value
 * 7. Salvo el archivo listo para el uso de los web services
 */

$doc1 = new DOMDocument();
$doc1->load($factura);
$doc2 = new DOMDocument();
$doc2->load($firma);
$doc3 = new DOMDocument();
$doc3->formatOutput = TRUE;
$doc3->load($lote);
// Traverse the document
traverseLote( $doc3 );
ponerDigest( $salida );
exit();
/*
  Traverses each node of the DOM document recursively
*/

function traverseLote( $node )

{
    global $doc, $doc1, $doc2, $doc3;
    $getComprobante = $doc1->getElementsByTagName( 'factura' ) -> item(0);
    $getNuevo = $doc3 ->importNode($getComprobante, true);
    $getLote = $doc3 ->getElementsByTagName( 'comprobante' ) ->item(0);
    $getLote->appendChild($getNuevo);
    
    $getFirma = $doc2->documentElement;
    $getNuevo = $doc3 ->importNode($getFirma, true);
    $doc3 ->documentElement -> appendChild( $getNuevo );

 $param = "salidaFactura.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc3->C14NFile( $salida );   
}
function ponerDigest( $salida ) {

$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$doc->load($salida);
$xmlDoc = $doc->C14N();
$digest = base64_encode(pack("H*", sha1( $xmlDoc )));
echo 'Todo el documento => ' . $digest . '<br>';
//$grupo = $doc->documentElement->namespaceURI;
//$cuerpo = $doc->getElementsByTagNameNS( $grupo, 'etsi:SignedProperties' )->item(0);
//$xmlDoc = $cuerpo->C14N( TRUE, TRUE );
//$digest = base64_encode(pack("H*", sha1( $xmlDoc )));
//echo 'Signed tag => ' . $digest . '\n\n';

}
