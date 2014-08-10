<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if (!isset($_SESSION['carrillosteam'])) {
require ('paraContinuar.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
       exit();
}
    require ('firmaNotaCredito.html');
    exit();
