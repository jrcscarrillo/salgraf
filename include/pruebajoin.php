<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    /*
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
    $numero = $stmt->affected_rows();
    if ($numero > 0) {
        $flagPasa = 'Actualizacion OK';
    }
    return $flagPasa;
}
function generaXML($param) {
    global $db, $doc;
    $sql = "SELECT i.RefNumber, i.CustomerRef_FullName, i.BillAddress_Addr2, i.TxnDate";
    $sql .= "l.ItemRef_FullName, l.Description, l.Quantity, l.Rate, l.Amount, i.CustomField15";
    $sql .= " FROM invoice i join invoicelinedetail l on i.TxnID = l.IDKEY ";
    $sql .= "WHERE i.TxnDate = '2014-06-10' and i.CustomField15 = 'PASA FIRMA' ";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_result($db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo);        /* fetch values */
    $stmt->execute();
    $control = 0;
    $procesadas = 0;
    $totalFactura = 0;
    $totalLote = 0;
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('Facturas');
    $factura = $doc->createElement('factura');
    
    while ($stmt->fetch()) {
        if ($control == 0) {
             $control = $db_RefNumber;
             }
        if ($control != $db_RefNumber) {
             $flagTotalFactura = totalFactura();
        } 
        if ($db_Item != NULL) {
             $flagItem = procesaItem();
         } else {
            echo 'NULL';
         }
    }
        exit();
} 

function totalFactura() {
    global $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    
    $infoFactura = $doc->createElement('infoFactura', $db_infoFactura);
    $fechaEmision = $doc->createElement('fechaEmision', $db_TxnDate);
    $dirEstablecimiento = $doc->createElement('dirEstablecimiento', $_SESSION['emisor']);
    $contribuyenteEspecial = $doc->createElement('contribuyenteEspecial', $_SESSION['resolucion']);
    $obligadoContabilidad = $doc->createElement('obligadoContabilidad', $_SESSION['contabilidad']);
    $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
    if ($db_Ruc == '9999999999999') {
        $db_tipoIdentificacionComprador = "07";
    } else {
        if (strlen($db_Ruc) == 10) {
            $db_tipoIdentificacionComprador = "05";    
        }
    }
        
    $tipoIdentificacionComprador = $doc->createElement('tipoIdentificacionComprador', $db_tipoIdentificacionComprador);
    $razonSocialComprador = $doc->createElement('razonSocialComprador', $db_Name);
    $identificacionComprador = $doc->createElement('identificacionComprador', $db_Ruc);
    $totalSinImpuestos = $doc->createElement('totalSinImpuestos', $facturaSinImp);
    $totalDescuento = $doc->createElement('totalDescuento', $facturaDesc);
    $totalConImpuestos = $doc->createElement('totalConImpuestos');
    $totalImpuesto = $doc->createElement('totalImpuesto');
    $codigo = $doc->createElement('codigo', $fijoCodImp);
    $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $fijoPorcentaje);
    $baseImponible = $doc->createElement('baseImponible', $facturaBase);
    $valor = $doc->createElement('valor', $facturaValorImp);
    
    $totalImpuesto->appendChild($codigo);
    $totalImpuesto->appendChild($codigoPorcentaje);
    $totalImpuesto->appendChild($baseImponible);
    $totalImpuesto->appendChild($valor);
    $totalConImpuestos->appendChild($totalImpuesto);
    
    $db_propina = 0;
    $propina = $doc->createElement('propina', $db_propina);
    $importeTotal = $doc->createElement('importeTotal', $facturaTotal);
    $db_moneda = "DOLAR";
    $moneda = $doc->createElement('moneda', $db_moneda);

        $infoFactura->appendChild($fechaEmision);
        $infoFactura->appendChild($dirEstablecimiento);
        $infoFactura->appendChild($contribuyenteEspecial);
        $infoFactura->appendChild($obligadoContabilidad);
        $infoFactura->appendChild($tipoIdentificacionComprador);
        $infoFactura->appendChild($razonSocialComprador);
        $infoFactura->appendChild($identificacionComprador);
        $infoFactura->appendChild($totalSinImpuestos);
        $infoFactura->appendChild($totalDescuento);
        $infoFactura->appendChild($totalConImpuestos);
        $infoFactura->appendChild($propina);
        $infoFactura->appendChild($importeTotal);
        $infoFactura->appendChild($moneda);
        
        $detalles = $doc->createElement('detalles');
$facturaBase = 0;
$facturaValorImp = 0;
$facturaSinImp = 0;
$facturaDesc = 0;
$facturaTotal = 0;
    
    $infoTributaria = $doc->createElement('infoTributaria');
    $ambiente = $doc->createElement('ambiente', $_SESSION['ambiente']);
    $tipoEmision = $doc->createElement('tipoEmision', $_SESSION['emision']);
    $razonSocial = $doc->createElement('razonSocial', $_SESSION['Razon']);
    $nombreComercial = $doc->createElement('nombreComercial', $_SESSION['comercial']);
    $ruc = $doc->createElement('ruc', $_SESSION['Ruc']);
    
    $db_claveAcceso = crea_clave();
    $claveAcceso = $doc->createElement('claveAcceso', $db_claveAcceso);
        $db_codDoc = '01';
        $codDoc = $doc->createElement('codDoc', $db_codDoc);
        $db_estab = $_SESSION['establecimiento'];
        $estab = $doc->createElement('estab', $db_estab);
        $db_ptoEmi = $_SESSION['puntoemision'];
        $ptoEmi = $doc->createElement('ptoEmi', $db_ptoEmi);
        
        $secuencial = $doc->createElement('secuencial', $db_RefNumber);
        $db_dirMatriz = $_SESSION['matriz'];
        $dirMatriz = $doc->createElement('dirMatriz', $db_dirMatriz);
 
        $infoTributaria->appendChild($ambiente);
        $infoTributaria->appendChild($codigo);
        $infoTributaria->appendChild($razonSocial);
        $infoTributaria->appendChild($nombreComercial);
        $infoTributaria->appendChild($ruc);
        $infoTributaria->appendChild($claveAcceso);
        $infoTributaria->appendChild($codDoc);
        $infoTributaria->appendChild($estab);
        $infoTributaria->appendChild($ptoEmi);
        $infoTributaria->appendChild($secuencial);
        $infoTributaria->appendChild($dirMatriz);
}

function crea_clave() {
    global $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    include 'claveAcceso.php';
    $args['fecha'] = '27072014';
    $args['tipodoc'] = '01';
    $args['ruc'] = $db_Ruc; // llenar a 13 si es cedula
    $args['ambiente'] = $_SESSION['ambiente'];
    $args['establecimiento'] = $_SESSION['establecimiento'];
    $args['punto'] = $_SESSION['puntoemision'];
    $args['factura'] = $db_RefNumber; // llenar a 9
    $args['codigo'] = $db_RefNumber; // mismo numero factura? o secuencial
    $args['emision'] = $_SESSION['emision'];
    $claveArray = [];
    $claveArray = generaClave($args);
    echo 'Esta es la resultante ';
    var_dump($claveArray);
    $digito = poneDigito($claveArray);
    $claveArray[48] = $digito;
    return $claveArray;
}
function procesaItem() {
    global $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    
    $detalle = $doc->createElement('detalle');
    $codigoPrincipal = $doc->createElement('codigoPrincipal', $db_Item);
    $descripcion = $doc->createElement('descripcion', $db_descripcion);
    $cantidad = $doc->createElement('cantidad', $db_Quantity);
    $precioUnitario = $doc->createElement('precioUnitario', $db_Rate);
    $db_descuento = 0;
    $descuento = $doc->createElement('descuento', $db_descuento);
    $precioTotalSinImpuesto = $doc->createElement('precioTotalSinImpuesto', $db_Amount);
    $impuestos = $doc->createElement('impuestos');
    $impuesto = $doc->createElement('impuesto');
    $codigo = $doc->createElement('codigo', $fijoCodImp);
    $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $fijoPorcentaje);
    $tarifa = $doc->createElement('tarifa', $fijoTarifa);
    $baseImponible = $doc->createElement('baseImponible', $db_Amount);
    $db_valor = $db_Amount * $fijoTarifa / 100;
    $valor = $doc->createElement('valor', $db_valor);
    
    $impuesto->appendChild($codigo);
    $impuesto->appendChild($codigoPorcentaje);
    $impuesto->appendChild($tarifa);
    $impuesto->appendChild($baseImponible);
    $impuesto->appendChild($valor);
    $impuestos->appendChild($impuesto);
    
    $detalle->appendChild($codigoPrincipal);
    $detalle->appendChild($descripcion);
    $detalle->appendChild($cantidad);
    $detalle->appendChild($precioUnitario);
    $detalle->appendChild($descuento);
    $detalle->appendChild($precioTotalSinImpuesto);
    $detalle->appendChild($impuestos);
    $detalles->appendChild($detalle);
    
    $facturaBase = $facturaBase + $db_Amount;
    $facturaValorImp = $facturaValorImp + $db_valor;
    $facturaSinImp = $facturaSinImp + $db_Amount;
    $facturaDesc = 0;
    $facturaTotal = $facturaTotal + $db_Amount + $db_valor;
}
 