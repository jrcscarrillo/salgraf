<?php

/* 
 * En este programa solo se genera el esqueleto del lote masivo de documentos
 */
session_start();
/* 
 * @Author: Juan Carrillo
 * @Date: 16 de Agosto del 2014
 * @Project: Comprobantes Electronicos
 */
if (!isset($_SESSION['carrillosteam'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
        exit();
}
    /*
     *  Se controla que en la sesion este presente el usuario con la autorizacion
     *  y tambien que haya seleccionado el contribuyente que facturara
     */
if (!isset($_SESSION['establecimiento']) or !isset($_SESSION['puntoemision'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR No ha seleccionado Contribuyente');".
        "})".
        "</script>";
        exit();
}
$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root = $doc ->createElement( 'lote-masivo');
$root ->setAttribute('id', 'lote');
$root ->setAttribute('version', '1.1.0');
/*
 * Definicion del esqueleto del documento para los lotes masivos ....
 */
    $db_ambiente = $_SESSION['ambiente'];
    $ambiente = $doc->createElement('ambiente', $db_ambiente);
    $db_tipoEmision = $_SESSION['emision'];
    $tipoEmision = $doc->createElement('tipoEmision', $db_tipoEmision);
    $db_ruc = $_SESSION['Ruc'];
    $ruc = $doc->createElement('ruc', $db_ruc);
    $db_claveAcceso = '1234567890123456789012345678901234567890123456789';
    $claveAcceso = $doc->createElement('claveAcceso', $db_claveAcceso);
    $db_estab = $_SESSION['establecimiento'];
    $establecimiento = $doc->createElement('estab', $db_estab);
    $db_codDoc = '01';
    $codDoc = $doc ->createElement( 'codDoc' , $db_codDoc);
    $comprobantes = $doc ->createElement( 'comprobantes' );
    $comprobantes->setAttribute('id', 'comprobante');
    $comprobante = $doc ->createElement( 'comprobante' );


$comprobantes ->appendChild( $comprobante);
$root ->appendChild( $ambiente );
$root ->appendChild( $tipoEmision );
$root ->appendChild( $ruc );
$root ->appendChild( $claveAcceso );
$root ->appendChild( $establecimiento );
$root ->appendChild( $codDoc );
$root ->appendChild( $comprobantes );

$doc -> appendChild($root);

$param = "loteMasivoTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();