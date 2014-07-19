<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

function mensajea($pasaerr) {
include ('paraMensajes.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text($pasaerr);".
        "})".
        "</script>";
       exit();
}

function continua($pasaSuccess) {
include ('paraContinuar.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text($pasaSuccess);".
        "})".
        "</script>";
       exit();
}