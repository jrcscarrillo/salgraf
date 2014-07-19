<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 6 2014
 * Proyecto: Comprobantes Electronicos
 */

session_start();
if ($_SESSION['carrillosteam'] == 'carrillosteam') {
    require ('enviaFactura.html');
        exit();
    } else {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
        exit();
}