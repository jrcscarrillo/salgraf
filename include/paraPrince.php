<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../prince.php';

function paraPrince($param) {

$prince = new Prince("/Apps/Engine/bin/prince");
if(!$prince) 
{	die("<p>Prince instantiation failed</p>");	}
else 
{	echo "Prince instantiation OK<br />";	}

try{
    $directorio = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/';
    $prince->convert_file($directorio . $param);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}