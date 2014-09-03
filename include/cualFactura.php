<?php
session_start();
if ($_SESSION['carrillosteam'] != 'carrillosteam') {
require ('paraContinuar.html');
echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').html('Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
}

include 'conectaBaseDatos.php';

if (isset($_POST['facturaForm'])) {
    $factura = $_POST['facturaForm'];
    $flagDB = chkFactura();
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "select * from invoice where TxnRefNumber=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ii", $estab, $punto);
    $stmt->bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
    $existe = $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt ->close();
        $flagNew = "No existe Contribuyente";
        $flagNew = nuevoContribuyente($db);
    } else {
        $stmt->close();
            $flagNew  = "Codigo establecimiento y punto de emision Ya Existen";
            }

    /* close statement */
    $db->close();
    return $flagNew;
}

function nuevoContribuyente($db) {
    global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $nota, $telefono, $token;
    global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $ambiente, $emision;
    global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_ambiente, $wk_emision;
    $sql = "insert into Contribuyente(ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial, ContribuyenteDirMatriz, ";
    $sql .= "ContribuyenteDirEmisor, ContribuyenteCodEmisor, ContribuyentePunto, ContribuyenteResolucion, ";
    $sql .= "ContribuyenteLlevaContabilidad, ContribuyenteAmbiente, ContribuyenteEmision";
    $sql .= ") values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));

    $stmt->bind_param("issssiissii", $ruc, $razon, $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $ambiente, $emision);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    $sql = "select * from Contribuyente where idContribuyente=?";
    if ($selectTaskStmt = $db->prepare($sql)) {
        $selectTaskStmt->bind_param("i", $newId);
        $selectTaskStmt->bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
        $selectTaskStmt->execute();
        if ($selectTaskStmt->fetch()) {
            $flagDB = "Contribuyente adicionado";
        } else {
            $flagDB = "error contribuyente no se adiciono";
        }
    }
    return $flagDB;
}

function chkMail() {
   
    global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $nota, $telefono, $token;
    global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $ambiente, $emision;
    global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_ambiente, $wk_emision;
    	
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    
    $part = '<div><b>RUC: </b>' . $ruc . "<br>" . '<b>Razon: </b>' . $razon . "<br>";
    $part .= '<b>Nombre Comercial: </b>' . $comercial . "<br>" . '<b>Direccion Oficina Principal: </b>' . $matriz . "<br>";
    $part .= '<b>Direccion Emisor: </b>' . $emisor . "<br>" . '<b>Codigo Establecimiento: </b>' . $estab . "<br>";
    $part .= '<b>Codigo Punto de Emision: </b>' . $punto . "<br>";
    $part .= '<b>Numero Resolucion: </b>' . $resol . "<br>";
    $part .= '<b>Lleva Contabilidad?: </b>' . $lleva . "<br>";
    $part .= '<b>Ambiente de Proceso: </b>' . $ambiente . "<br>";
    $part .= '<b>Forma de Emisiom: </b>' . $emision . "<br>";
    $part .= '<br><hr><br><span>Este contribuyente se ha adicionado correctamente</span></div>'; 
    
    $body = 'RUC: ' . $ruc . 'Razon: ' . $razon . "   ";
    $body .= 'Nombre Comercial: ' . $comercial . "  " . 'Direccion Oficina Principal: ' . $matriz . "    ";
    $body .= 'ireccion Emisor: ' . $emisor . "    " . 'Codigo Establecimiento: ' . $estab . "   ";
    $body .= 'Codigo Punto de Emision: ' . $punto . "    ";
    $body .= 'Numero Resolucion: ' . $resol . "    ";
    $body .= 'Lleva Contabilidad?: ' . $lleva . "    ";
    $body .= 'Ambiente de Proceso: ' . $ambiente . "    ";
    $body .= 'Forma de Emisiom: ' . $emision . "    ";
    $body .= 'Este contribuyente se ha adicionado correctamente';  
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Nuevo Contribuyente';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
    $paraemail['toemail']['email'] = 'jrcscarrillo@gmail.com';
    $paraemail['toemail']['nombre'] = 'Juan Carrillo';
//    var_dump($paraemail);
    $flagEmail = enviamail($paraemail);
    return $flagEmail;
}

