<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 6, 2014
 * Proyecto: Comprobantes Electronicos
 */
var_dump($GLOBALS);
    session_start();
    if (!isset($_SESSION['carrillosteam']) == 'carrillosteam') {
        require 'paraMensajes.html';
        echo '<script type="text/javascript">'.
                "$(document).ready(function(){".
                "$('#mensaje').text('*** ERROR Usuario no ha ingresado al sistema');".
                "})".
                "</script>";
}
    include 'conectaBaseDatos.php';
if (isset($_POST['Archivo'])) {
    $archivo = str_replace("},", "}|", $_POST['Archivo']);
    $archi = explode("|", $archivo);
    for($i=0; $i < count($archi); $i++) {
    $registro = json_decode($archi[$i]);
    var_dump($archi[$i]);
    if(strlen($archi[$i]) != 0){
        foreach ($registro as $key => $value) {
//            echo "Estos Datos {$key} is {$value}\n";
            if($key === "Nombre_Archivo"){
                $wk_archivo = $value;
            } elseif ($key === "Generado") {
                $wk_generado = $value;
            } elseif ($key === "Descargado") {
                $wk_descargado = $value;
            } elseif ($key === "Procesado") {
                $wk_procesado = $value;
                chkArchivo($wk_archivo, $wk_generado, $wk_descargado, $wk_procesado);
            }
        }
    }
    }
} 

function chkArchivo($wk_archivo, $wk_generado, $wk_descargado, $wk_procesado) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    echo "Numero: " . $wk_factura . " \n";
    $stmt = "";
    $sql = "select ArchivoNombre, ArchivoGenerado, ArchivoDescargado, ArchivoProcesado from Archivo where ArchivoNombre = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("s", $wk_archivo);
    $flag = FALSE;
    $existe = $stmt->execute();
    $stmt->bind_result($db_archivo, $db_generado, $db_descargado, $db_procesado);        /* fetch values */
            while ($stmt->fetch()) {
                $flag = TRUE;
            }
    $stmt->close();
    $db->close();
/*
 *          Si existe algun archivo que se pueda enviar al SRI
 *          no debe tener fechas en el campo ArchivoProcesado
 *          Si cumple estas condiciones proceder a enviar el archivo a ser procesador
 *          por los servicios internet provistos por
 */        
    if($flag){
        $control = sendArchivo($wk_archivo, $wk_generado, $wk_descargado, $wk_procesado);
        if($control){
            echo '{ "Continua":"GO" }';
            exit();
            }
            }
 }

function sendArchivo($wk_archivo, $wk_generado, $wk_descargado, $wk_procesado) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $today = date("Ymd H:i:s");
    $sql = "UPDATE Archivo SET ArchivoProcesado = ? where ArchivoNombre=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ss", $today, $wk_archivo);
    $flag = FALSE;
    $existe = $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    if ($nroRegistrosAfectados > 0) {
        $flag = TRUE;
    }
        /* close statement */
    $stmt->close();
    $db->close();
    return $flag;
}
