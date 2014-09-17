<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    $param = $_POST['archivo'] . '.xml';
//    $param = 'Juancho.xml';
//    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
//    poneDigest($salida);
function poneDigest($param) {
    
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $doc->load($param);
//    traverseDocument($doc);
//    $delLote = $doc->getElementById('DelLote');
    $losDigest = $doc->getElementsByTagName('DigestValue');
    foreach ($losDigest as $key) {
        
        if ($key->hasAttributes()){
            if ($key->getAttribute('id') == 'DelLote') {
                echo 'tiene esto de valor ' . $key->nodeValue . '<br>';
                $key->nodeValue = 'Cambia Valor';
            }
            echo 'Esta es la id ' . $key->getAttribute('id') . '<br>';    
        }
    }
    $doc->save($param);
    exit();
}
function init() {
    
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('Facturas');
    $factura = $doc->createElement('factura');
    $root->appendChild($factura);
    $doc->appendChild($root);
    $doc->save('juancho.xml');
    traverseDocument( $doc );
    totalFactura();
    traverseDocument( $doc );
    itemFactura();
    traverseDocument( $doc );
    exit();
}
    function totalFactura() {
        global $doc;
        $facturas = $doc->getElementsByTagName('Facturas')->item(0);
        $factura = $doc->getElementsByTagName('factura')->item(0);
        $infoFactura = $doc->createElement('infoFactura');
        $fechaEmision = $doc->createElement('fechaEmision');
        $factura->appendChild($infoFactura);
        $factura->appendChild($fechaEmision);
        $facturas->appendChild($factura);
        $doc->appendChild($facturas);
        $doc->save('juancho.xml');
        }
    function itemFactura() {
        global $doc;
        $facturas = $doc->getElementsByTagName('Facturas')->item(0);
        $factura = $doc->getElementsByTagName('factura')->item(0);
        $item = $doc->createElement('codigo');
        $nombre = $doc->createElement('descripcion');
        $factura->appendChild($item);
        $factura->appendChild($nombre);
        $facturas->appendChild($factura);
        $doc->appendChild($facturas);
        $doc->save('juancho.xml');
        }
/*
  Traverses each node of the DOM document recursively
*/

function traverseDocument( $node )
{
  switch ( $node->nodeType )
  {
    case XML_ELEMENT_NODE:
        
        if ($node->tagName == 'ds:DigestValue') {
            echo "Found element: \"$node->tagName\"";
            }
//      echo "Found element: \"$node->tagName\"";

      if ( $node->hasAttributes() ) {
          
//        echo " with attributes: ";
        foreach ( $node->attributes as $attribute ) {
            if ($node->tagName == 'ds:DigestValue') {
                echo "$attribute->name=\"$attribute->value\" ";
                if($attribute->value == 'DelLote'){
                    echo '***** encontro del lote *****';
                }
            }
//          echo "$attribute->name=\"$attribute->value\" ";
        }
      }

      echo "\n";
      break;

    case XML_TEXT_NODE:
      if ( trim($node->wholeText) ) {
          if ($node->parentNode->tagName == 'ds:DigestValue') {
              echo "Found text node: \"$node->wholeText\"\n";
          }
//        echo "Found text node: \"$node->wholeText\"\n";
      }
      break;

case XML_CDATA_SECTION_NODE:
  if ( trim($node->data) ) {
    echo "Found character data node: \"" .
    htmlspecialchars($node->data) . "\"\n";
  }
  break;

}
if ( $node->hasChildNodes() ) {
  foreach ( $node->childNodes as $child ) {
    traverseDocument( $child );
  }
 }
}

 