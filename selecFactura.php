<?php

/* 
 * @Author: Juan Carrillo
 * @Date: 1 de Agosto del 2014
 * @Project: Comprobantes Electronicos
 */

session_start();
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
$_SESSION['programa'] = "Seleccionando Facturas";        
require ('selectFactura.html');
exit();
