<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 3, 2014
 * Modificado: Julio 24, 2014 (Modifica js)
 * Modificado: Agosto 6, 2014 ($_SESSION)
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
            } elseif ($key === "Especial") {
                $wk_resol = $value;
            } elseif ($key === "Ambiente") {
                $wk_ambiente = $value;
            } elseif ($key === "Emision") {
                $wk_emision = $value;
                $flagDB = chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab, $wk_resol, $wk_ambiente, $wk_emision);
            }
        }
    }}
    echo $flagDB;    
    exit();
} 
                
                
function chkContribuyente($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab, $wk_resol, $wk_ambiente, $wk_emision) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    echo "Contribuyente: " . $wk_ruc . " \n";
    $stmt = "";
    $sql = "select ";
    $sql .= "ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial, ";
    $sql .= "ContribuyenteCodEmisor, ContribuyentePunto, ContribuyenteDirMatriz, ";
    $sql .= "ContribuyenteDirEmisor, ContribuyenteLlevaContabilidad, ";
    $sql .= "ContribuyenteResolucion, ContribuyenteAmbiente, ";
    $sql .= "ContribuyenteEmision ";
    $sql .= "from Contribuyente where ContribuyenteCodEmisor=? and ContribuyentePunto=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("ss", $wk_estab, $wk_punto);
    $flagDB = "";
    $existe = $stmt->execute();
    $stmt->bind_result($db_ruc, $db_razon, $db_comercial, $db_estab, $db_punto, $db_matriz, $db_emisor, $db_contab, $db_resol, $db_ambiente, $db_emision);        /* fetch values */
    while ($stmt->fetch()) {
        $flagDB = "Se acceso al registro del Contribuyente";
        updateSession($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab, $wk_resol, $wk_ambiente, $wk_emision);
        }
    /* close statement */
    $stmt->close();
    $db->close();
    if($flagDB == ""){
        $flagDB = "No se acceso al registro del Contribuyente";
        }
        return $flagDB;
    }
    
function updateSession($wk_ruc, $wk_razon, $wk_comercial, $wk_estab, $wk_punto, $wk_matriz, $wk_emisor, $wk_contab, $wk_resol, $wk_ambiente, $wk_emision) {

    $_SESSION['Ruc'] = $wk_ruc;
    $_SESSION['Razon'] = $wk_razon;
    $_SESSION['Comercial'] = $wk_comercial;
    $_SESSION['establecimiento'] = $wk_estab;
    $_SESSION['puntoemision'] = $wk_punto;
    $_SESSION['matriz'] = $wk_matriz;
    $_SESSION['emisor'] = $wk_emisor;
    $_SESSION['contabilidad'] = $wk_contab;
    $_SESSION['resolucion'] = $wk_resol;
    $_SESSION['ambiente'] = $wk_ambiente;
    $_SESSION['emision'] = $wk_emision;
}
?>