<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function traverseDocument( $node )
{
  switch ( $node->nodeType )
  {
    case XML_ELEMENT_NODE:
      echo "Found element: \"$node->tagName\"";

      if ( $node->hasAttributes() ) {
        echo " with attributes: ";
        foreach ( $node->attributes as $attribute ) {
          echo "$attribute->name=\"$attribute->value\" ";
        }
      }

      echo "\n";
      break;

    case XML_TEXT_NODE:
      if ( trim($node->wholeText) ) {
        echo "Found text node: \"$node->wholeText\"\n";

					  


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
