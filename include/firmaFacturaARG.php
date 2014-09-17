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
$args['codigoImpuesto'] = 2;
$args['porcentajeImpuesto'] = 12;
$args['codigoTarifaImpuesto'] = 2;
$args['baseImponible'] = 0;
$args['valorImpuestos'] = 0;
$args['valorSinImpuestos'] = 0;
$args['valorDescuentos'] = 0;
$args['valorTotal'] = 0;
include 'conectaQuickBooks.php';
include 'claveAcceso.php';
include 'cambiaString.php';
include '../utilitarios/mergeComprobantes.php';

    $flagPasa = pasaFirma($args);
    $flagGenera = generaXML($args);
        if ($flagGenera == 'Generacion OK') {
            $flagConvertida = convierte();
            if ($flagConvertida == 'Conversion OK') {
                $flagXML = mergeXMLs();
                if ($flagXML == "Listo Lote") {
                    echo 'Listo para el webservice';
                }
            }
            
        }

exit();
function pasaFirma($args) {
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
function generaXML($args) {
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
             $args['numeroDocumento'] = $db_RefNumber;
             $args['razonSocial'] = $db_Name;
             $args['ruc'] = $db_Ruc;
             $args['fechaDocumento'] = $db_TxnDate;
             $args['numeroTransaccion'] = $db_TxnNumber;
             $args['customfield15'] = $db_Campo;
             $args['direccionComprador'] = $db_direccionComprador;
             $stringDetalles = '<detalles>';
             }
        if ($control != $db_RefNumber) {
            $args['xmlDetalles'] = $stringDetalles;
             totalFactura($args);             
             $args['numeroDocumento'] = $db_RefNumber;
             $args['razonSocial'] = $db_Name;
             $args['ruc'] = $db_Ruc;
             $args['fechaDocumento'] = $db_TxnDate;
             $args['numeroTransaccion'] = $db_TxnNumber;
             $args['customfield15'] = $db_Campo;
             $args['direccionComprador'] = $db_direccionComprador;
             $control = $db_RefNumber;
             $args['baseImponible'] = 0;
             $args['valorImpuestos'] = 0;
             $args['valorSinImpuestos'] = 0;
             $args['valorDescuentos'] = 0;
             $args['valorTotal'] = 0;
             $stringDetalles = '<detalles>';
             
        } 
        if ($db_Item != NULL) {
            $args['codigoProducto'] = $db_Item;
             $args['descripcionProducto'] = $db_descripcion;
             $args['cantidad'] = $db_Quantity;
             $args['precioProducto'] = $db_Rate;
             $args['valorProducto'] = $db_Amount;
            $param = procesaItem($args);
            $args['baseImponible'] = $param['baseImponible'];
            $args['valorImpuestos'] = $param['valorImpuestos'];
            $args['valorSinImpuestos'] = $param['valorSinImpuestos'];
            $args['valorDescuentos'] = $param['valorDescuentos'];
            $args['valorTotal'] = $param['valorTotal'];
            $stringDetalles .= $param['xmlItem'];
            
        } 
    }
    if ($control != 0) {
        totalFactura($args);
    }
    $stmt->close();
    $db->close();
    exit();
} 

function totalFactura($args) {
    
    echo 'Entrando al proceso total factura ';
    var_dump($args);
    
    $param = crea_clave($args);
    
    echo 'Despues del proceso de claves';
    var_dump($param);
    $db_claveAcceso1 = implode($param['claveAcceso']);
    $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
    if ($param['rucLimpio'] == '9999999999999') {
        $db_tipoIdentificacionComprador = "07";
    } else {
        if (strlen($param['rucLimpio']) == 10) {
            $db_tipoIdentificacionComprador = "05";    
        }
    }
    $stringDate = strtotime($args['fechaDocumento']);
    $dateString = date('d/m/Y', $stringDate);
    $out_SinImp = number_format($args['valorSinImpuestos'], '2', '.', '');
    $out_Base = number_format($args['baseImponible'], '2', '.','');
    $out_ValorImp = number_format($args['valorImpuestos'], '2', '.','');
    $out_Total = number_format($args['valorTotal'], '2', '.','');
    $regresaName = limpiaString($args['razonSocial']);
    $regresaDireccion = limpiaString($args['direccionComprador']);
    $stringTributaria = '<infoTributaria><ambiente>' . $_SESSION['ambiente'] . '</ambiente>';
    $stringTributaria .= '<tipoEmision>' . $_SESSION['emision'] . '</tipoEmision><razonSocial>' . $_SESSION['Razon'] . '</razonSocial>';
    $stringTributaria .= '<nombreComercial>' . $_SESSION['Comercial'] . '</nombreComercial>';
    $stringTributaria .= '<ruc>' . $_SESSION['Ruc'] . '</ruc><claveAcceso>' . $db_claveAcceso1 . '</claveAcceso><codDoc>01</codDoc>';
    $stringTributaria .= '<estab>' . $_SESSION['establecimiento'] . '</estab><ptoEmi>' .  $_SESSION['puntoemision'] . '</ptoEmi><secuencial>' . $param['numeroDocumentoLleno'] . '</secuencial>';
    $stringTributaria .= '<dirMatriz>' . $_SESSION['matriz'] . '</dirMatriz></infoTributaria>';
    $stringInfo = '<infoFactura><fechaEmision>' . $dateString . '</fechaEmision><dirEstablecimiento>' . $regresaDireccion . '</dirEstablecimiento>';
    $stringInfo .= '<obligadoContabilidad>' . $_SESSION['contabilidad'] . '</obligadoContabilidad>';
    $stringInfo .= '<tipoIdentificacionComprador>' . $db_tipoIdentificacionComprador . '</tipoIdentificacionComprador><razonSocialComprador>' . 'PRUEBAS SERVICIO DE RENTAS INTERNAS' . '</razonSocialComprador>';
    $stringInfo .= '<identificacionComprador>' . $param['rucLimpio'] . '</identificacionComprador><totalSinImpuestos>' . $out_SinImp . '</totalSinImpuestos>';
    $stringInfo .= '<totalDescuento>0.00</totalDescuento><totalConImpuestos><totalImpuesto><codigo>' . $args['codigoImpuesto'];
    $stringInfo .= '</codigo><codigoPorcentaje>' . $args['porcentajeImpuesto'] . '</codigoPorcentaje><baseImponible>' . $out_Base . '</baseImponible>';
    $stringInfo .= '<valor>' . $out_ValorImp . '</valor></totalImpuesto></totalConImpuestos><propina>0.00</propina><importeTotal>' . $out_Total;
    $stringInfo .= '</importeTotal><moneda>DOLAR</moneda></infoFactura>';

    $stringFactura = '<factura id="comprobante" version="1.1.0">' . $stringTributaria . $stringInfo . $args['xmlDetalles'] . '</detalles></factura>';
    
    $stringDoc = '<?xml version="1.0" encoding="UTF-8" ?>';
    $stringDoc .= $stringFactura;
    file_put_contents('factura.xml', $stringDoc);
    file_put_contents('InfoFactura.xml', $stringInfo);
    $prefijo = $_POST['archivo'] . $args['numeroDocumento'] . '.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $prefijo;
    juntaComprobantes($salida);
//    include_once 'SRIcliente.php';
//    enviaComprobante($salida);
    }

function crea_clave($param) {

    $stringDate = strtotime($param['fechaDocumento']);
    $dateString = date('dmY', $stringDate);
    $args['fecha'] = $dateString;
    $args['tipodoc'] = '01';
    
    $args1['dato'] = $param['ruc'];
    $args1['longitud'] = 12; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $param['rucLimpio'] = implode(generaString($args1));
    
    $args['ruc'] = $_SESSION['Ruc']; // llenar a 13 si es cedula
    
    $args['ambiente'] = $_SESSION['ambiente'];
    $args['establecimiento'] = $_SESSION['establecimiento'];
    $args['punto'] = $_SESSION['puntoemision'];
     
    $args1['dato'] = $param['numeroDocumento'];
    $args1['longitud'] = 8; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $param['numeroDocumentoLleno'] = implode(generaString($args1));   
    
    $args['factura'] = $param['numeroDocumentoLleno']; // llenar a 9
    
    $args1['dato'] = $param['numeroTransaccion'];
    $args1['longitud'] = 7; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $param['numeroTransaccionLleno'] = implode(generaString($args1));    
    
    $args['codigo'] = $param['numeroTransaccionLleno']; // mismo numero factura? o secuencial
    $args['emision'] = $_SESSION['emision'];
    $claveArray = [];
//    var_dump($args);
    $claveArray = generaClave($args);
//    echo 'Esta es la resultante ';
//    var_dump($claveArray);
    $param['claveAcceso'] = $claveArray;
    return $param;
}
function procesaItem($args) {
    echo 'Entrando al proceso por items';
    var_dump($args);
    $db_valor = $args['valorProducto'] * $args['porcentajeImpuesto'] / 100;
    $out_valor = number_format($db_valor, '2', '.', '');
    $out_Amount = number_format($args['valorProducto'], '2', '.', '');
    $regresaDescripcion = limpiaString($args['descripcionProducto']);
    $stringItem = '<detalle><codigoPrincipal>'. $args['codigoProducto'] . '</codigoPrincipal>';
    $stringItem .= '<descripcion>'. $regresaDescripcion . '</descripcion><cantidad>' . $args['cantidad'] . '</cantidad>';
    $stringItem .= '<precioUnitario>' . $args['precioProducto'] . '</precioUnitario><descuento>0</descuento>';
    $stringItem .= '<precioTotalSinImpuesto>' . $out_Amount . '</precioTotalSinImpuesto><detallesAdicionales><detAdicional/></detallesAdicionales>';
    $stringItem .= '<impuestos><impuesto><codigo>' . $args['codigoImpuesto'] . '</codigo><codigoPorcentaje>' . $args['codigoTarifaImpuesto'] . '</codigoPorcentaje>';
    $stringItem .= '<tarifa>' . $args['porcentajeImpuesto'] . '</tarifa><baseImponible>' . $out_Amount . '</baseImponible><valor>' . $out_valor . '</valor></impuesto></impuestos></detalle>';
     
    $args['baseImponible'] = $args['baseImponible'] + $args['valorProducto'];
    $args['valorImpuestos'] = $args['valorImpuestos'] + $db_valor;
    $args['valorSinImpuestos'] = $args['valorSinImpuestos'] + $args['valorProducto'];
    $args['valorTotal'] = $args['valorTotal'] + $args['valorProducto'] + $db_valor;
    $args['xmlItem'] = $stringItem;
    return $args;
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
