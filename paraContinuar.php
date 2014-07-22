<?php
$mensaje = "No ha llegado Mensajes";
//var_dump($_COOKIE);
if(isset($_COOKIE['Continuar'])) {
    $mensaje = $_COOKIE['Continuar'];
}
require ('paraContinuar.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text($mensaje);".
        "})".
        "</script>";