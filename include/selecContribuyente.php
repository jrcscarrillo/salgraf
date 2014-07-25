<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 3, 2014
 * Modificado: Julio 24, 2014 (Modifica js)
 * Proyecto: Comprobantes Electronicos
 */
session_start();
//var_dump($_POST);
include 'conectaBaseDatos.php';

if (isset($_POST['Contribuyente'])) {
    $contribuyente = str_replace("},", "}|", $_POST['Contribuyente']);
//    var_dump($contribuyente);
    $estab = explode("|", $contribuyente);
    for($i=0; $i < count($estab); $i++) {
    $registro = json_decode($estab[$i]);
//    var_dump($estab[$i]);
    if(strlen($estab[$i]) != 0){
        foreach ($registro as $key => $value) {
//            echo "Estos Datos {$key} is {$value}\n";
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
                $flagDB = chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab);
            } 
        }
    }}
    $var_programa = $_SESSION['programa'];
    if ($flagDB == "Se acceso al registro del Contribuyente" and $var_programa == "selecFactura") {
        $flagDB = "Contribuyente Seleccionado en Seleccion Factura";
    } elseif ($flagDB == "Se acceso al registro del Contribuyente" and $var_programa == "firmaFactura") {
        $flagDB = "Contribuyente Seleccionado en Firma Factura";
        } elseif ($flagDB == "No se acceso al registro del Contribuyente" and $var_programa == "selecFactura") {
            $flagDB = "Contribuyente NO Seleccionado en Seleccion Factura";
            } elseif ($flagDB == "No se acceso al registro del Contribuyente" and $var_programa == "firmaFactura") {
                $flagDB = "Contribuyente NO Seleccionado en Firma Factura";    
        }
        echo $flagDB;    
    exit();
} 

function chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    echo "Contribuyente: " . $wk_ruc . " \n";
    $stmt = "";
    $sql = "select ";
    $sql .= "ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial, ";
    $sql .= "ContribuyenteCodEmisor, ContribuyentePunto, ContribuyenteDirMatriz, ";
    $sql .= "ContribuyenteDirEmisor, ContribuyenteLlevaContabilidad ";
    $sql .= "from Contribuyente where ContribuyenteCodEmisor=? and ContribuyentePunto=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("ss", $wk_estab, $wk_punto);
    $flagDB = "";
    $existe = $stmt->execute();
    $stmt->bind_result($db_ruc, $db_razon, $db_comercial, $db_estab, $db_punto, $db_matriz, $db_emisor, $db_contab);        /* fetch values */
    while ($stmt->fetch()) {
        $flagDB = "Se acceso al registro del Contribuyente";
        updateSession($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab);
        }
    /* close statement */
    $stmt->close();
    $db->close();
    if($flagDB == ""){
        $flagDB = "No se acceso al registro del Contribuyente";
        }
        return $flagDB;
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
}
?>