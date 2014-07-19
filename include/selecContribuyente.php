<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 3, 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
var_dump($_SESSION);
include 'conectaBaseDatos.php';
require 'mensajes.php';

if (isset($_POST['Contribuyente'])) {
    $contribuyente = str_replace("},", "}|", $_POST['Contribuyente']);
    $estab = explode("|", $contribuyente);
    for($i=0; $i < count($estab); $i++) {
    $registro = json_decode($estab[$i]);
    var_dump($estab[$i]);
    if(strlen($estab[$i]) != 0){
        foreach ($registro as $key => $value) {
            echo "Estos Datos {$key} is {$value}\n";
            if($key === "Ruc"){
                $wk_ruc = $value;
            } elseif ($key === "Razon") {
                $wk_razon = $value;
            } elseif ($key === "Comercial") {
                $wk_comercial = $value;
            } elseif ($key === "Establecimiento") {
                $wk_estab = $value;
            } elseif ($key === "Punto Emision") {
                $wk_punto = $value;
            } elseif ($key === "Direccion matriz") {
                $wk_matriz = $value;
            } elseif ($key === "Direccion Emisor") {
                $wk_emisor = $value;
            } elseif ($key === "Lleva Contabilidad") {
                $wk_contab = $value;                
                chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab);
            } 
        }
    }}
    echo "Termino Proceso de Seleccion";
    exit();
} else {
    header("content-type: text/html");
    $pasaerr = "*** ERROR no ha seleccionado contribuyente";
    echo("*** ERROR no ha seleccionado contribuyente");
    mensajea($pasaerr);
    exit();
}

function chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    echo "Contribuyente: " . $wk_ruc . " \n";
    $stmt = "";
    $sql = "select ";
    $sql .= "ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial, ";
    $sql .= "ContribuyenteCodEmisor, ContribuyentePunto, ContribuyenteDirMatriz, ";
    $sql .= "ContribuyenteDirEmisor, ContribuyenteLlevaContabilidad ";
    $sql .= "from Contribuyente where ContribuyenteCodEmisor=? and ContribuyentePunto=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("ss", $wk_estab, $wk_punto);
    $flag = FALSE;
    $existe = $stmt->execute();
    $stmt->bind_result($db_ruc, $db_razon, $db_comercial, $db_estab, $db_punto, $db_matriz, $db_emisor, $db_contab);        /* fetch values */
    while ($stmt->fetch()) {
        $flag = TRUE;
        echo 'Si encontro al ' . $db_ruc . ' con la razon social ' . $db_razon;
    }
    /* close statement */
    $stmt->close();
    $db->close();
    if($flag){
        updateSession($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab);
    }
    }

function updateSession($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab) {

    $_SESSION['Ruc'] = $wk_ruc;
    $_SESSION['Razon'] = $wk_razon;
    $_SESSION['Comercial'] = $wk_comercial;
    $_SESSION['establecimiento'] = $wk_estab;
    $_SESSION['puntoemision'] = $wk_punto;
    $_SESSION['matriz'] = $wk_matriz;
    $_SESSION['emisor'] = $wk_emisor;
    $_SESSION['contabilidad'] = $wk_contab;
    echo 'Estas son las variables: ' . $wk_ruc + ' ' . $wk_razon;
    header("content-type: text/html");
    $pasaSuccess = "*** Continuar ha seleccionado contribuyente";
    echo("*** Continuar ha seleccionado contribuyente");
    continua($pasaSuccess);
    exit();
}
?>