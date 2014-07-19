<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'conectaBaseDatos.php';
function asignaClave($param, $referencia) {
    $flag = FALSE;
    $wk_id = 0;
    $wk_tipo = 0;
    $wk_numero = 0;
    $wk_transito = 0;
    $wk_usado = 0;
    $wk_fecha = "";
    $wk_referencia = 0;
    
    $db = db_connect();
    $sql = "select * from ClaveAsignada where ClaveAsignadaDoc=? and ClaveAsignadaTransito = ? and ClaveAsignadaUsada = ? limit 1";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("iii", $param, $wk_transito, $wk_usado);
    $stmt->bind_result($wk_id, $wk_tipo, $wk_numero, $wk_transito, $wk_usado, $wk_fecha, $wk_referencia);
    $existe = $stmt->execute();
    var_dump($wk_id, $param);
    if ($stmt->fetch()){
        $flag = TRUE;
        echo "Numero asignado OK\r\n";       
    } else {
        echo "No existe numero para asignar\r\n";        
    }
    $stmt->close();  
    $db->close();
    if ($flag) {
        $flag1 = poneTransito($param, $referencia, $wk_id);
        return $flag1;
    } else {
        return FALSE;
    }
}
function poneTransito($param, $referencia, $wk_id) {
    $db = db_connect(); 
    $stmt = "";
    $today = new DateTime();
    $today = $today->format('Y-m-d H:i:s');
    $sql = "update ClaveAsignada set ClaveAsignadaTransito = 1, ClaveAsignadaFecha = now(), ClaveAsignadaReferencia = $referencia where idClaveAsignada=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("i", $wk_id);
    $existe = $stmt->execute();
    var_dump($wk_id, $param, $referencia);
    if (!$existe) {
        $stmt->close();
        echo "No se actualizo numero de clave asignada\r\n";
        return FALSE;
    } else {
        $stmt->close();
        return TRUE;
    }
    
}