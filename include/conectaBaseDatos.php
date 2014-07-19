<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function db_connect() {
    $userName = "srijrcscarrillo";
    $password = "F9234568!s";
    $dbName = "srijrcscarrillo";
    $server = "srijrcscarrillo.db.10949679.hostedresource.com";
    $db = new mysqli($server, $userName, $password, $dbName);
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }   
   return $db;
}
