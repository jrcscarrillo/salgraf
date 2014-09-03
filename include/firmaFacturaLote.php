<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Agosto 22, 2014
 * 
 * Proyecto: Comprobantes Electronicos
 * Version: 2.0
 * Primero: Actualiza en invoice en el campo CustomField15 por hasta 50 facturas con "PASA FIRMA"
 * Segundo: Lee las "PASA FIRMA" y genere el XML comprobante en un archivo en el Servidor
 * Tercero: Actualiza las "PASA FIRMA" a "CONVERTIDAS"
 * Cuarto: Genera el archivo de lotes en XML
 * 4.1. genera el digest de comprobanteTemplate.xml
 * 4.2. Usando el template de lotemasico aumenta comprobanteTemplate.xml
 * 4.3. Usando el template de lotemasico aumenta firmaFirma.xml
 * 4.4. Guarda el documento XML
 * 
 */
 
session_start();
$fijoCodImp = 2;
$fijoPorcentaje = 12;
$fijoTarifa = 2;
$facturaBase = 0;
$facturaValorImp = 0;
$facturaSinImp = 0;
$facturaDesc = 0;
$facturaTotal = 0;
include 'conectaQuickBooks.php';
include 'claveAcceso.php';
include 'cambiaString.php';
include '../utilitarios/mergeComprobantes.php';

    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }

    $flagPasa = pasaFirma();
    if ($flagPasa == 'Actualizacion OK') {
        $flagGenera = generaXML();
        if ($flagGenera == 'Generacion OK') {
            $flagConvertida = convierte();
            if ($flagConvertida == 'Conversion OK') {
                $flagXML = mergeXMLs();
                if ($flagXML == "Listo Lote") {
                    echo 'Listo para el webservice';
                }
            }
            
        }
}
exit();
function pasaFirma() {
    global $db;
    $flagPasa = 'Inicio pasaFirma';
    $sql = "UPDATE invoice SET CustomField15 = 'PASA FIRMA' where CustomField15 = 'SELECCIONADA' LIMIT 5";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->execute();
    $numero = $stmt->affected_rows;
    if ($numero > 0) {
        $flagPasa = 'Actualizacion OK';
    }
    return $flagPasa;
}
function generaXML() {
    global $db, $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $db_claveAcceso1, $wk_RefNumber, $wk_Name, $wk_Ruc, $wk_TxnDate, $wk_Item, $wk_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa, $detalles, $infoTributaria, $infoFactura, $factura;
    $sql = "SELECT i.RefNumber, i.CustomerRef_FullName, i.BillAddress_Addr2, i.TxnDate, ";
    $sql .= "l.ItemRef_FullName, l.Description, l.Quantity, l.Rate, l.Amount, i.CustomField15";
    $sql .= " FROM invoice i join invoicelinedetail l on i.TxnID = l.IDKEY ";
    $sql .= "WHERE i.CustomField15 = 'PASA FIRMA' ";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_result($db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo);        /* fetch values */
    $stmt->execute();
    $control = 0;
    $procesadas = 0;
    $totalFactura = 0;
    $totalLote = 0;

    while ($stmt->fetch()) {
//        echo 'Lee Factura => ' . $db_RefNumber;
        if ($control == 0) {
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
             $wk_Campo =$db_Campo;
             $stringDetalles = '<detalles>';
             $stringComprobante = '<comprobante id="comprobantes">';
             }
        if ($control != $db_RefNumber) {
             $stringFactura = totalFactura();
             $stringComprobante .= $stringFactura . $stringDetalles . '</detalles></factura>';
//             var_dump($stringComprobante, $stringDetalles);
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
             $stringDetalles = '<detalles>';
             
        } 
        if ($db_Item != NULL) {
            $stringItem = procesaItem();
            $stringDetalles .= $stringItem;
            
        } 
    }
    if ($control != 0) {
        $stringFactura = totalFactura();
        $stringComprobante .= $stringFactura . $stringDetalles . '</detalles></factura>';
    }
    $stmt->close();
    $db->close();
    
    $stringDoc = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><lote-masivo id="lote" version="1.0.0"><ambiente>';
    $stringDoc .= $_SESSION['ambiente'] . '</ambiente><tipoEmision>';
    $stringDoc .= $_SESSION['emision'] . '</tipoEmision><ruc>';
    $stringDoc .= $_SESSION['Ruc'] . '</ruc><claveAcceso>';
    $stringDoc .= $db_claveAcceso1 . '</claveAcceso><establecimiento>';
    $stringDoc .= $_SESSION['establecimiento'] . '</establecimiento><codDoc>01</codDoc><comprobantes>';
    $stringDoc .= $stringComprobante . '</comprobante></comprobantes></lote-masivo>';
    file_put_contents('loteMasivo.xml', $stringDoc);
    $stringComprobante .= '</comprobante>';
    file_put_contents('comprobante.xml', $stringComprobante);
    juntaComprobantes();
    include 'SRIcliente.php';
    $param = $_POST['archivo'] . '.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    enviaComprobante($salida);
    exit();
} 

function totalFactura() {
    global $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $db_claveAcceso1, $wk_RefNumber, $wk_Name, $wk_Ruc, $wk_TxnDate, $wk_Item, $wk_descripcion, $wk_Quantity, $wk_Rate, $wk_Amount, $wk_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa, $regresaRuc;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    
    $db_claveAcceso = crea_clave();
    $db_claveAcceso1 = implode($db_claveAcceso);
    $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
    if ($wk_Ruc == '9999999999999') {
        $db_tipoIdentificacionComprador = "07";
    } else {
        if (strlen($wk_Ruc) == 10) {
            $db_tipoIdentificacionComprador = "05";    
        }
    }
    $stringDate = strtotime($wk_TxnDate);
    $dateString = date('d/m/Y', $stringDate);
    $out_SinImp = number_format($facturaSinImp, '2', ',', '');
    $out_Base = number_format($facturaBase, '2', ',','');
    $out_ValorImp = number_format($facturaValorImp, '2', ',','');
    $out_Total = number_format($facturaTotal, '2', ',','');
    $stringFactura = '<factura id="comprobante" version="1.1.1"><infoTributaria><ambiente>' . $_SESSION['ambiente'] . '</ambiente>';
    $stringFactura .= '<tipoEmision>' . $_SESSION['emision'] . '</tipoEmision><razonSocial>PRUEBAS SERVICIO DE RENTAS INTERNA</razonSocial>';
    $stringFactura .= '<nombreComercial>PRUEBAS SERVICIO DE RENTAS INTERNA</nombreComercial>';
    $stringFactura .= '<ruc>' . $_SESSION['Ruc'] . '</ruc><claveAcceso>' . $db_claveAcceso1 . '</claveAcceso><codDoc>01</codDoc>';
    $stringFactura .= '<estab>' . $_SESSION['establecimiento'] . '</estab><ptoEmi>' .  $_SESSION['puntoemision'] . '</ptoEmi><secuencial>' . $wk_RefNumber . '</secuencial>';
    $stringFactura .= '<dirMatriz>' . $_SESSION['matriz'] . '</dirMatriz></infoTributaria>';
    $stringFactura .= '<infoFactura><fechaEmision>' . $dateString . '</fechaEmision><dirEstablecimiento>' . $_SESSION['emisor'] . '</dirEstablecimiento>';
    $stringFactura .= '<contribuyenteEspecial>' . $_SESSION['resolucion'] . '</contribuyenteEspecial><obligadoContabilidad>' . $_SESSION['contabilidad'] . '</obligadoContabilidad>';
    $stringFactura .= '<tipoIdentificacionComprador>' . $db_tipoIdentificacionComprador . '</tipoIdentificacionComprador><razonSocialComprador>'.'</razonSocialComprador>';
    $stringFactura .= '<identificacionComprador>' . $regresaRuc . '</identificacionComprador><totalSinImpuestos>' . $out_SinImp . '</totalSinImpuestos>';
    $stringFactura .= '<totalDescuento>' . $facturaDesc . '</totalDescuento><totalConImpuestos><totalImpuesto><codigo>' . $fijoCodImp;
    $stringFactura .= '</codigo><codigoPorcentaje>' . $fijoPorcentaje . '</codigoPorcentaje><baseImponible>' . $out_Base . '</baseImponible>';
    $stringFactura .= '<valor>' . $out_ValorImp . '</valor></totalImpuesto></totalConImpuestos><propina>0.00</propina><importeTotal>' . $out_Total;
    $stringFactura .= '</importeTotal><moneda>DOLAR</moneda></infoFactura>';
        
    $facturaBase = 0;
    $facturaValorImp = 0;
    $facturaSinImp = 0;
    $facturaDesc = 0;
    $facturaTotal = 0;
    return $stringFactura;
    }

function crea_clave() {
    global $doc, $wk_RefNumber, $wk_Name, $wk_Ruc, $wk_TxnDate, $wk_Item, $wk_descripcion, $wk_Quantity, $wk_Rate, $wk_Amount, $wk_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa, $regresaRuc;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    
    $stringDate = strtotime($wk_TxnDate);
    $dateString = date('dmY', $stringDate);
    $args['fecha'] = $dateString;
    $args['tipodoc'] = '01';
    
    $args1['dato'] = $wk_Ruc;
    $args1['longitud'] = 12; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $regresaRuc = implode(generaString($args1));
    
    $args['ruc'] = $regresaRuc; // llenar a 13 si es cedula
    
    $args['ambiente'] = $_SESSION['ambiente'];
    $args['establecimiento'] = $_SESSION['establecimiento'];
    $args['punto'] = $_SESSION['puntoemision'];
     
    $args1['dato'] = $wk_RefNumber;
    $args1['longitud'] = 8; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $regresaString = implode(generaString($args1));   
    
    $args['factura'] = $regresaString; // llenar a 9
    
    $args1['dato'] = $wk_RefNumber;
    $args1['longitud'] = 7; // debe ser -1 de la longitud deseada
    $args1['vector'] = 'D'; //I=Izquierdo D=Derecho;
    $args1['relleno'] = 'N'; //N=Numero A=Alfas;
    $regresaString = implode(generaString($args1));    
    
    $args['codigo'] = $regresaString; // mismo numero factura? o secuencial
    $args['emision'] = $_SESSION['emision'];
    $claveArray = [];
//    var_dump($args);
    $claveArray = generaClave($args);
//    echo 'Esta es la resultante ';
//    var_dump($claveArray);
    return $claveArray;
}
function procesaItem() {
    global $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    $db_valor = $db_Amount * $fijoPorcentaje / 100;
    $out_valor = number_format($db_valor, '2', ',', '');
    $out_Amount = number_format($db_Amount, '2', ',', '');
    $stringItem = '<detalle><codigoPrincipal>'. $db_Item . '</codigoPrincipal><codigoAuxiliar>'.'</codigoAuxiliar>';
    $stringItem .= '<descripcion>'. $db_descripcion . '</descripcion><cantidad>' . $db_Quantity . '</cantidad>';
    $stringItem .= '<precioUnitario>' . $db_Rate . '</precioUnitario><descuento>0</descuento>';
    $stringItem .= '<precioTotalSinImpuesto>' . $out_Amount . '</precioTotalSinImpuesto><detallesAdicionales><detAdicional/></detallesAdicionales>';
    $stringItem .= '<impuestos><impuesto><codigo>' . $fijoCodImp . '</codigo><codigoPorcentaje>' . $fijoPorcentaje . '</codigoPorcentaje>';
    $stringItem .= '<tarifa>' . $fijoTarifa . '</tarifa><baseImponible>' . $out_Amount . '</baseImponible><valor>' . $out_valor . '</valor></impuesto></impuestos></detalle>';
     
    $facturaBase = $facturaBase + $db_Amount;
    $facturaValorImp = $facturaValorImp + $db_valor;
    $facturaSinImp = $facturaSinImp + $db_Amount;
    $facturaDesc = 0;
    $facturaTotal = $facturaTotal + $db_Amount + $db_valor;
    return $stringItem;
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
