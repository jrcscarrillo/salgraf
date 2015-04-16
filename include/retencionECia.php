<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:  Septiembre 10, 2014
 * 
 * Proyecto: Comprobantes Electronicos
 * Version: 2.0
 * Primero: Actualiza en la tabla vendorcrediten el campo CustomField15 "SELECCIONADA" con "PASA FIRMA"
 * Segundo: Lee las "PASA FIRMA"
 * 2.1. genera comprobante.xml y comprobantes.xml
 * 2.2. calcula digest del comprobante.xml
 * 2.3. genera el XML con el nombre compuesta por el nombre del usuario y numero de factura en en el Servidor
 * 2.4. modifica el XML con el digest calculado
 * 2.5. genera una entrada en la tabla archivo y guarda el archivo
 * Tercero: Toma cada archivo no procesado 
 * 3.1. Envia archivo a validar el comprobante
 * 3.2. Si tiene errores emite y sigue con otro
 * 3.3. Si no tiene errores requiere autorizacion del SRI
 * 3.4. Recibe autorizacion
 * 3.5. Actualiza tabla archivo
 * 3.6. Actualiza DB salgraf tablas de retenciones
 * 3.7. Envia mail a usuario con la retencion autorizada
 * 
 */
session_start();
$args['valorRetencion'] = 0;
$args['totalRetencion'] = 0;
$args['codDoc'] = "07"; 

include 'conectaQuickBooks.php';
include 'claveAcceso.php';
include 'cambiaString.php';
include '../utilitarios/mergeComprobantes.php';
$flagPasa = pasaFirma();
$flagGenera = generaXML();
exit();

function pasaFirma() {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $flagPasa = 'Inicio pasaFirma';
    $sql = "UPDATE vendorcredit SET CustomField15 = 'PASA FIRMA' where CustomField15 = 'SELECCIONADA'";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->execute();
    $numero = $stmt->affected_rows;
    $stmt->close();
    $db->close();
    return $flagPasa;
}
function generaXML($args) {
 
    $sql = "SELECT v.TxnID, v.TxnNumber, v.VendorRef_FullName, v.TxnDate, ";
    $sql .= "v. CreditAmount, v.RefNumber, v.Memo, t.ItemRef_FullName, t.Description, ";
    $sql .+ "t.Quantity, t.Cost, t.Amount, t.IDKEY FROM `vendorcredit` v ";
    $sql .= "LEFT JOIN txnitemlinedetail t ON v.TxnID = t.IDKEY ";
    $sql .= "WHERE v.CustomField15 = 'PASA FIRMA' ";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_result($db_TxnId, $db_TxnNumber, $db_VendorRef_FullName, $db_TxnDate, $db_RefNumber, $db_Memo, $db_ItemRef_FullName, $db_Description, $db_Quantity, $db_Cost, $db_Amount, $db_Idkey);        /* fetch values */
    $stmt->execute();
    $control = 0;
    $procesadas = 0;
    $totalFactura = 0;
    $totalLote = 0;

    while ($stmt->fetch()) {
        if ($control == 0) {
             $control = $db_RefNumber;
             $_SESSION['numeroDocumento'] = $db_RefNumber;
             $_SESSION['razonSocial'] = $db_VendorRef_FullName;
             $_SESSION['rucComprador'] = $db_Ruc;
             $_SESSION['fechaDocumento'] = $db_TxnDate;
             $_SESSION['numeroTransaccion'] = $db_TxnNumber;
             $_SESSION['customfield15'] = $db_Campo;
             $_SESSION['direccionComprador'] = $db_direccionComprador;
             $stringDetalles = '<detalles>';
             }
        if ($control != $db_RefNumber) {
             totalFactura();
             $control = $db_RefNumber;
             $wk_RefNumber = $db_RefNumber;
             $wk_Name = $db_Name;
             $wk_Ruc = $db_Ruc;
             $wk_TxnDate = $db_TxnDate;
             $wk_Item = $db_Item;
             $wk_descripcion = $db_descripcion;
             $wk_Quantity = $db_Quantity;
             $wk_Rate = $db_Rate;
             $wk_Amount = $db_Amount;
             $wk_Campo = $db_Campo;
             $wk_direccionComprador = $db_direccionComprador;
             $stringDetalles = '<detalles>';
             
        } 
        if ($db_Item != NULL) {
            $stringItem = retencion_unaXuna();
            $stringDetalles .= $stringItem;
            
        } 
    }
    if ($control != 0) {
        totalFactura();
    }
    $stmt->close();
    $db->close();
    exit();
} 
function retencion_unaXuna($param) {
    $stringImpuesto = '<impuesto><codigo>' . $wk_ . '</codigo><codigoRetencion>' . $wk_ . '</codigoRetencion>';
    $stringImpuesto .= '<baseImponible>' . $wk_ . '</baseImponible>' . '<porcentajeRetener>' . $wk_ . '</porcentajeRetener>';
    $stringImpuesto .= '<valorRetenido>' . $wk_ . '</valorRetenido>' . '<codDocSustento>' . $wk_ . '</codDocSustento>';
    $stringImpuesto .= '<numDocSustento>' . $wk_ . '</numDocSustento><fechaEmisionDocSustento>' . $wk_ . '</fechaEmisionDocSustento>';
    $stringImpuesto .= '</impuesto>';
}

function retencionCabecera($param) {
    echo 'Entrando al proceso total factura ';
    var_dump($_SESSION);
    
    crea_clave();
    $db_claveAcceso1 = implode($_SESSION['claveAcceso']);
    $stringTributaria = '<infoTributaria><ambiente>' . $_SESSION['ambiente'] . '</ambiente>';
    $stringTributaria .= '<tipoEmision>' . $_SESSION['emision'] . '</tipoEmision><razonSocial>' . $_SESSION['Razon'] . '</razonSocial>';
    $stringTributaria .= '<nombreComercial>' . $_SESSION['Comercial'] . '</nombreComercial>';
    $stringTributaria .= '<ruc>' . $_SESSION['Ruc'] . '</ruc><claveAcceso>' . $db_claveAcceso1 . '</claveAcceso><codDoc>01</codDoc>';
    $stringTributaria .= '<estab>' . $_SESSION['establecimiento'] . '</estab><ptoEmi>' .  $_SESSION['puntoemision'] . '</ptoEmi><secuencial>' . $_SESSION['numeroDocumentoLleno'] . '</secuencial>';
    $stringTributaria .= '<dirMatriz>' . $_SESSION['matriz'] . '</dirMatriz></infoTributaria>';
    $stringCab .= '<infoCompRetencion><fechaEmision>' . $args['fechaEmision'] . '</fechaEmision><dirEstablecimiento>' . $args['direccion'] . '</dirEstablecimiento>';
    $stringCab .= '<contribuyenteEspecial>' . $args['especial'] . '</contribuyenteEspecial><obligadoContabilidad>' . $args['contribuyente_E'] . '</obligadoContabilidad>';
    $stringCab .= '<tipoIdentificacionSujetoRetenido>'. $args['tipoDocmto'] . '</tipoIdentificacionSujetoRetenido>';
    $stringCab .= '<razonSocialSujetoRetenido>'. $wk_ . '</razonSocialSujetoRetenido>';
    $stringCab .= '<identificacionSujetoRetenido>'. $wk_ . '</identificacionSujetoRetenido>';
    $stringCab .= '<periodoFiscal>'. $wk_ . '</periodoFiscal></infoCompRetencion><impuestos>';

    $stringRetencion = '<comprobanteRetencion id="comprobante" version="1.1.1">' . $stringTributaria . $stringCab . $_SESSION['xmlImpuestos'] . '</impuestos></comprobanteRetencion>';
    
    $stringDoc = '<?xml version="1.0" encoding="UTF-8" ?>';
    $stringDoc .= $stringRetencion;
    file_put_contents('retencion.xml', $stringDoc);
    file_put_contents('InfoRetencion.xml', $stringCab);
    $prefijo = $_POST['archivo'] . $_SESSION['numeroDocumento'] . '.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $prefijo;
    juntaComprobantes($salida);
//    include_once 'SRIcliente.php';
//    enviaComprobante($salida);
}

function crea_clave() {

    $stringDate = strtotime($_SESSION['fechaDocumento']);
    $dateString = date('dmY', $stringDate);
    $args['fecha'] = $dateString;
    $args['tipodoc'] = '01';
    
    $args1['dato'] = $_SESSION['rucComprador'];
    $args1['longitud'] = 12; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $_SESSION['rucLimpio'] = implode(generaString($args1));
    
    $args['ruc'] = $_SESSION['Ruc']; // llenar a 13 si es cedula
    
    $args['ambiente'] = $_SESSION['ambiente'];
    $args['establecimiento'] = $_SESSION['establecimiento'];
    $args['punto'] = $_SESSION['puntoemision'];
     
    $args1['dato'] = $_SESSION['numeroDocumento'];
    $args1['longitud'] = 8; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $_SESSION['numeroDocumentoLleno'] = implode(generaString($args1));   
    
    $args['factura'] = $_SESSION['numeroDocumentoLleno']; // llenar a 9
    
    $args1['dato'] = $_SESSION['numeroTransaccion'];
    $args1['longitud'] = 7; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $_SESSION['numeroTransaccionLleno'] = implode(generaString($args1));    
    
    $args['codigo'] = $_SESSION['numeroTransaccionLleno']; // mismo numero factura? o secuencial
    $args['emision'] = $_SESSION['emision'];
    $claveArray = [];
//    var_dump($args);
    $claveArray = generaClave($args);
//    echo 'Esta es la resultante ';
//    var_dump($claveArray);
    $_SESSION['claveAcceso'] = $claveArray;
    return TRUE;
}		



function generaArchivo($archivo) {

    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $today = date("Y-m-d H:i:s");
    $sql = "insert into Archivo(ArchivoNombre, ArchivoGenerado";
    $sql .= ") values(?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ss", $archivo, $today);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    $sql = "select ArchivoNombre from Archivo where idArchivo=?";
    if ($selectTaskStmt = $db->prepare($sql)) {
        $selectTaskStmt->bind_param("i", $newId);
        $selectTaskStmt->bind_result($wk_nombre);
        $selectTaskStmt->execute();
        if ($selectTaskStmt->fetch()) {
            echo "Archivo adicionado:" . $wk_nombre . "\r\n";
        } else {
            echo "error archivo no se adiciono\r\n";
        }
    }
}
