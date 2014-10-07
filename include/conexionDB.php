<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conecta_DB() {
    $userName = "root";
    $password = "salgraf";
    $dbName = "salgraf";
    $server = "localhost";
    $db = new mysqli($server, $userName, $password, $dbName);
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }   
   return $db;
}
