<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $param = 'copiaSRI.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    poneDigest($salida);
function poneDigest($param) {
    
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $doc->load($param);
    
    $losDigest = $doc->getElementsByTagName('SignedProperties');
 
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