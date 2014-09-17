<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../pdfcrowd.php';
$entrada = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/factura-salgraf.html';
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/factura-salgraf.pdf';
try
{   
    // create an API client instance
    $client = new Pdfcrowd("jrcscarrillo", "187e736861277258f84448ffd035edfb");
    $out_file = fopen($salida, "wb");
    $client->convertFile($entrada, $out_file);
    fclose($out_file);
//    $pdf = $client->convertFile($entrada);
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}