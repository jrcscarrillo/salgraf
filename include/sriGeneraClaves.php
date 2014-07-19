<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'conectaBaseDatos.php';
function desdeHastaClave($param, $desde, $hasta) {
    
    $today = new DateTime(); 
    $today = $today->format('Y-m-d H-i-s'); 
    $cero = 0;
    var_dump($param, $desde, $hasta, $today);
    $db = db_connect();
    $sql = "insert into ClaveAsignada(ClaveAsignadaDoc, ClaveAsignadaNumero, ClaveAsignadaTransito, ClaveAsignadaUsada, ClaveAsignadaFecha, ClaveAsignadaReferencia) values(?, ?, ?, ?, ?, ?)";
    
    while ($desde <= $hasta) {
        $stmt = $db->prepare($sql) or die(mysqli_error($db));
        $stmt->bind_param("iiiisi", $param, $desde, $cero, $cero, $today, $cero);
        $stmt->execute();
        $desde++;
    }
    $stmt->close(); 
    $db->close();
}
