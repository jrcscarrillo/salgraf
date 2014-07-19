<?php

/* 
 * @author: Juan Carrillo
 * @Dste:   7/17/2014
 * @Project: Salgraf
 * Este programa revisa que el usuario no este ingresado en el sistema
 * No ingresado: Envia la pantalla de ingreso al sistema
 * Ingresado: Envia mensaje
 */
session_start();
if (!isset($_SESSION['carrillosteam'])) {
    require ('login.html');
}
require ('paraMensajes.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').html('Usuario ya esta ingresado an el sistema');".
        "})".
        "</script>";
