<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Agosto 28, 2014
 * 
 * Proyecto: Comprobantes Electronicos
 * Version: 2.0
 * Primero: Actualiza en la tabla invoice en el campo CustomField15 "SELECCIONADA" con "PASA FIRMA"
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
 * 3.6. Actualiza DB salgraf tablas de factura y facturadetalle
 * 3.7. Envia mail a usuario con la factura autorizada
 * 
 */
 
session_start();
$_SESSION['codigoImpuesto'] = 2;
$_SESSION['porcentajeImpuesto'] = 12;
$_SESSION['codigoTarifaImpuesto'] = 2;
$_SESSION['baseImponible'] = 0;
$_SESSION['valorImpuestos'] = 0;
$_SESSION['valorSinImpuestos'] = 0;
$_SESSION['valorDescuentos'] = 0;
$_SESSION['valorTotal'] = 0;
include 'conectaQuickBooks.php';
include 'claveAcceso.php';
include 'cambiaString.php';
include '../utilitarios/calculaDigest.php';

    $flagPasa = pasaFirma();
    $flagGenera = generaXML();

exit();
function pasaFirma() {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $flagPasa = 'Inicio pasaFirma';
    $sql = "UPDATE invoice SET CustomField15 = 'PASA FIRMA' where CustomField15 = 'SELECCIONADA'";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->execute();
    $numero = $stmt->affected_rows;
    $stmt->close();
    $db->close();
    return $flagPasa;
}
function generaXML() {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "SELECT i.TxnNumber, i.RefNumber, i.CustomerRef_FullName, i.BillAddress_Addr2, i.BillAddress_Addr3, i.TxnDate, ";
    $sql .= "l.ItemRef_FullName, l.Description, l.Quantity, l.Rate, l.Amount, i.CustomField15";
    $sql .= " FROM invoice i join invoicelinedetail l on i.TxnID = l.IDKEY ";
    $sql .= "WHERE i.CustomField15 = 'PASA FIRMA' ";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_result($db_TxnNumber, $db_RefNumber, $db_Name, $db_Ruc, $db_direccionComprador, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo);        /* fetch values */
    $stmt->execute();
    $control = 0;
    $procesadas = 0;
    $totalFactura = 0;
    $totalLote = 0;

    while ($stmt->fetch()) {
        if ($control == 0) {
             $control = $db_RefNumber;
             $_SESSION['numeroDocumento'] = $db_RefNumber;
             $_SESSION['razonSocial'] = $db_Name;
             $_SESSION['rucComprador'] = $db_Ruc;
             $_SESSION['fechaDocumento'] = $db_TxnDate;
             $_SESSION['numeroTransaccion'] = $db_TxnNumber;
             $_SESSION['customfield15'] = $db_Campo;
             $_SESSION['direccionComprador'] = $db_direccionComprador;
             $stringDetalles = '<detalles>';
             }
        if ($control != $db_RefNumber) {
            $_SESSION['xmlDetalles'] = $stringDetalles;
             totalFactura();             
             $_SESSION['numeroDocumento'] = $db_RefNumber;
             $_SESSION['razonSocial'] = $db_Name;
             $_SESSION['rucComprador'] = $db_Ruc;
             $_SESSION['fechaDocumento'] = $db_TxnDate;
             $_SESSION['numeroTransaccion'] = $db_TxnNumber;
             $_SESSION['customfield15'] = $db_Campo;
             $_SESSION['direccionComprador'] = $db_direccionComprador;
             $control = $db_RefNumber;
             $_SESSION['baseImponible'] = 0;
             $_SESSION['valorImpuestos'] = 0;
             $_SESSION['valorSinImpuestos'] = 0;
             $_SESSION['valorDescuentos'] = 0;
             $_SESSION['valorTotal'] = 0;
             $stringDetalles = '<detalles>';
             
        } 
        if ($db_Item != NULL) {
            $_SESSION['codigoProducto'] = $db_Item;
             $_SESSION['descripcionProducto'] = $db_descripcion;
             $_SESSION['cantidad'] = $db_Quantity;
             $_SESSION['precioProducto'] = $db_Rate;
             $_SESSION['valorProducto'] = $db_Amount;
            procesaItem();
            $stringDetalles .= $_SESSION['xmlItem'];
            
        } 
    }
    if ($control != 0) {
        $_SESSION['xmlDetalles'] = $stringDetalles;
        totalFactura();
    }
    $stmt->close();
    $db->close();
    exit();
} 

function totalFactura() {
    
    echo 'Entrando al proceso total factura ';
    var_dump($_SESSION);
    
    crea_clave();
    $db_claveAcceso1 = implode($_SESSION['claveAcceso']);
    $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
    if ($_SESSION['rucLimpio'] == '9999999999999') {
        $db_tipoIdentificacionComprador = "07";
    } else {
        if (strlen($_SESSION['rucLimpio']) == 10) {
            $db_tipoIdentificacionComprador = "05";    
        }
    }
    $stringDate = strtotime($_SESSION['fechaDocumento']);
    $dateString = date('d/m/Y', $stringDate);
    $out_SinImp = number_format($_SESSION['valorSinImpuestos'], '2', '.', '');
    $out_Base = number_format($_SESSION['baseImponible'], '2', '.','');
    $out_ValorImp = number_format($_SESSION['valorImpuestos'], '2', '.','');
    $out_Total = number_format($_SESSION['valorTotal'], '2', '.','');
    $regresaName = limpiaString($_SESSION['razonSocial']);
    $regresaDireccion = limpiaString($_SESSION['direccionComprador']);
    if (substr($regresaDireccion, 0, 3) =='DIR') {
        $regresaDireccion = substr(limpiaString($_SESSION['direccionComprador']), 3);
    }    
    $stringTributaria = '<infoTributaria><ambiente>' . $_SESSION['ambiente'] . '</ambiente>';
    $stringTributaria .= '<tipoEmision>' . $_SESSION['emision'] . '</tipoEmision><razonSocial>' . $_SESSION['Razon'] . '</razonSocial>';
    $stringTributaria .= '<nombreComercial>' . $_SESSION['Comercial'] . '</nombreComercial>';
    $stringTributaria .= '<ruc>' . $_SESSION['Ruc'] . '</ruc><claveAcceso>' . $db_claveAcceso1 . '</claveAcceso><codDoc>01</codDoc>';
    $stringTributaria .= '<estab>' . $_SESSION['establecimiento'] . '</estab><ptoEmi>' .  $_SESSION['puntoemision'] . '</ptoEmi><secuencial>' . $_SESSION['numeroDocumentoLleno'] . '</secuencial>';
    $stringTributaria .= '<dirMatriz>' . $_SESSION['matriz'] . '</dirMatriz></infoTributaria>';
    $stringInfo = '<infoFactura><fechaEmision>' . $dateString . '</fechaEmision><dirEstablecimiento>' . $regresaDireccion . '</dirEstablecimiento>';
    $stringInfo .= '<obligadoContabilidad>' . $_SESSION['contabilidad'] . '</obligadoContabilidad>';
    $stringInfo .= '<tipoIdentificacionComprador>' . $db_tipoIdentificacionComprador . '</tipoIdentificacionComprador><razonSocialComprador>' . 'PRUEBAS SERVICIO DE RENTAS INTERNAS' . '</razonSocialComprador>';
    $stringInfo .= '<identificacionComprador>' . $_SESSION['rucLimpio'] . '</identificacionComprador><totalSinImpuestos>' . $out_SinImp . '</totalSinImpuestos>';
    $stringInfo .= '<totalDescuento>0.00</totalDescuento><totalConImpuestos><totalImpuesto><codigo>' . $_SESSION['codigoImpuesto'];
    $stringInfo .= '</codigo><codigoPorcentaje>' . $_SESSION['codigoTarifaImpuesto'] . '</codigoPorcentaje><baseImponible>' . $out_Base . '</baseImponible>';
    $stringInfo .= '<valor>' . $out_ValorImp . '</valor></totalImpuesto></totalConImpuestos><propina>0.00</propina><importeTotal>' . $out_Total;
    $stringInfo .= '</importeTotal><moneda>DOLAR</moneda></infoFactura>';

    $stringFactura = '<factura id="comprobante" version="1.1.0">' . $stringTributaria . $stringInfo . $_SESSION['xmlDetalles'] . '</detalles></factura>';
    
    $stringDoc = '<?xml version="1.0" encoding="UTF-8" ?>';
    $stringDoc .= $stringFactura;
    file_put_contents('factura.xml', $stringDoc);
    file_put_contents('InfoFactura.xml', $stringInfo);
    $prefijo = $_POST['archivo'] . $_SESSION['numeroDocumento'] . '.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $prefijo;
    juntaComprobantes($salida);
    calcularDgst($salida);
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
function procesaItem() {
    echo 'Entrando al proceso por items';
    var_dump($_SESSION);
    $db_valor = $_SESSION['valorProducto'] * $_SESSION['porcentajeImpuesto'] / 100;
    $out_valor = number_format($db_valor, '2', '.', '');
    $out_Amount = number_format($_SESSION['valorProducto'], '2', '.', '');
    $regresaDescripcion = limpiaString($_SESSION['descripcionProducto']);
    $stringItem = '<detalle><codigoPrincipal>'. $_SESSION['codigoProducto'] . '</codigoPrincipal>';
    $stringItem .= '<descripcion>'. $regresaDescripcion . '</descripcion><cantidad>' . $_SESSION['cantidad'] . '</cantidad>';
    $stringItem .= '<precioUnitario>' . $_SESSION['precioProducto'] . '</precioUnitario><descuento>0</descuento>';
    $stringItem .= '<precioTotalSinImpuesto>' . $out_Amount . '</precioTotalSinImpuesto><detallesAdicionales><detAdicional/></detallesAdicionales>';
    $stringItem .= '<impuestos><impuesto><codigo>' . $_SESSION['codigoImpuesto'] . '</codigo><codigoPorcentaje>' . $_SESSION['codigoTarifaImpuesto'] . '</codigoPorcentaje>';
    $stringItem .= '<tarifa>' . $_SESSION['porcentajeImpuesto'] . '</tarifa><baseImponible>' . $out_Amount . '</baseImponible><valor>' . $out_valor . '</valor></impuesto></impuestos></detalle>';
     
    $_SESSION['baseImponible'] = $_SESSION['baseImponible'] + $_SESSION['valorProducto'];
    $_SESSION['valorImpuestos'] = $_SESSION['valorImpuestos'] + $db_valor;
    $_SESSION['valorSinImpuestos'] = $_SESSION['valorSinImpuestos'] + $_SESSION['valorProducto'];
    $_SESSION['valorTotal'] = $_SESSION['valorTotal'] + $_SESSION['valorProducto'] + $db_valor;
    $_SESSION['xmlItem'] = $stringItem;
    return TRUE;
}
 
function generaArchivo($archivo) {
    include 'conexionDB.php';
    $db = conecta_DB();
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
//            echo "Archivo adicionado:" . $wk_nombre . "\r\n";
        } else {
//            echo "error archivo no se adiciono\r\n";
        }
    }
}
