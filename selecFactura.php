<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_SESSION['carrillosteam'] == 'carrillosteam') {
    
    /*
     *  Se controla que en la sesion este presente el usuario con la autorizacion
     *  y tambien que haya seleccionado el contribuyente que facturara
     */
    if (isset($_SESSION['establecimiento']) and isset($_SESSION['puntoemision'])) {
        require ('selecFactura.html');
        exit();
    } else {
        $_SESSION['programa'] = "selecFactura";
        require ('selecContribuyente.html');
        exit();
    }
} else {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
        exit();
}