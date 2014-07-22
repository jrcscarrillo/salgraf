<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 18 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
if ((!isset($_SESSION['carrillosteam'])) or (!isset($_SESSION['email']))){
    require ('paraContinuar.html');
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').html('Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
} else {
    if (($_SESSION['carrillosteam'] == 'carrillosteam') and ($_SESSION['email'] == 'jrcscarrillo@gmail.com')) {
        require ('habilita.html');
        exit();
        } else {
            require ('paraContinuar.html');
            echo '<script type="text/javascript">'.
                    "$(document).ready(function(){".
                    "$('#mensaje').html('Usuario no tiene autorizacion ');".
                    "})".
                    "</script>";
            }
        }
 