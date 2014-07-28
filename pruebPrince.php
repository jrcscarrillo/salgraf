<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'prince.php';
$prince = new Prince("/Apps/Engine/bin/prince");
if(!$prince) 
{	die("<p>Prince instantiation failed</p>");	}
else 
{	echo "Prince instantiation OK<br />";	}

try{
    $prince->convert_file("c:\\Apps\\factura\\factura\\factura.html");
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
//$prince->convert2('c:\\wamp\\www\Salgraf\\factura.html','c:\\wamp\\www\Salgraf\\generated.pdf');