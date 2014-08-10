<?php

/*
 * Autor:   Juan Carrillo
 * Fecha:   Julio 2 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
include 'conectaBaseDatos.php';
/*
 *      1. Revisar que la sesion tenga seleccionado al contribuyente
 *      2. Revisar que se hayan seleccionados las fechas para procesar
 */
if (!isset($_SESSION['establecimiento']) or !isset($_SESSION['puntoemision'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR No tiene seleccionado emisor');".
        "})".
        "</script>";
        exit();
}
if (isset($_POST['archivo'])) {
    $archivo = $_POST['archivo'];
    $flag = firmaFactura($archivo);
}

function firmaFactura($archivo) {
/*
 *      Consideraciones;
 *          La sesion debe tner cargaados todos los campo del emisor 
 *          para la generacion del archivo XML
 */    
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "select TxnID, "; // Numero transaccion index y foreign key para invoice line
    $sql .= "TimeCreated, "; // fecha de creacion del documento
    $sql .= "TimeModified, ";// fecha de modificacion del documento
    $sql .= "EditSequence, "; // control de secuencia de los movimientos
    $sql .= "TxnNumber, "; // Numero del documento
    $sql .= "CustomerRef_ListID, ";
    $sql .= "CustomerRef_FullName, ";
    $sql .= "TxnDate, "; // fecha de emision del documento
    $sql .= "RefNumber, ";
    $sql .= "BillAddress_Addr1, ";
    $sql .= "BillAddress_Addr2, "; // Aqui esta el numero del RUC
    $sql .= "BillAddress_Addr3, ";
    $sql .= "BillAddress_City, ";
    $sql .= "Subtotal, ";
    $sql .= "SalesTaxPercentaje, ";
    $sql .= "SalesTaxTotal, ";
    $sql .= "AppliedAmount, ";
    $sql .= "CustomField10 from invoice where CustomField10=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $selec = "SELECCIONADA";
    $stmt->bind_param("s", $selec);
    $flag = "*** ERROR no existen Facturas Seleccionadas";
    $stmt->execute();
    $stmt->bind_result($db_TxnID, $db_TimeCreated, $db_TimeModified, $db_EditSequence, $db_TxnNumber, $db_CustomerRef_ListID, $db_CustomerRef_FullName, $db_TxnDate, $db_RefNumber, $db_BillAddress_Addr1, $db_BillAddress_Addr2, $db_BillAddress_Addr3, $db_BillAddress_City, $db_Subtotal, $db_SalesTaxPercentaje, $db_SalesTaxTotal, $db_AppliedAmount, $db_CustomField10);        /* fetch values */
/*
 * DOMDocument es el nombre del objetgo para crear un archivo XML
 * Despues se utiliza la forma de PHP de generar tags en XML
 */
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('Facturas');
    $factura = $doc->createElement('factura');
/*
 *      Se procesan todas las facturas que tienen en el campo del usuario de la tabla de invoices del QB
 *      el estado SELECCIONADA
 */
    while ($stmt->fetch()) {

/*
 *      Informacion del Emisor
 */
        
        $infoTributaria = $doc->createElement('infoTributaria');
        $db_ambiente = $_SESSION['Ambiente'];
        $ambiente = $doc->createElement('ambiente', $db_ambiente);
        $db_tipoEmision = $_SESSION['Tipo Emision'];
        $tipoEmision = $doc->createElement('tipoEmision', $db_tipoEmision);
        $db_razonSocial = $_SESSION['Razon Social'];
        $razonSocial = $doc->createElement('razonSocial', $db_razonSocial);
        $db_nombreComercial = $_SESSION['Nombre Comercial'];
        $nombreComercial = $doc->createElement('nombreComercial', $db_nombreComercial);
        $db_ruc = $_SESSION['RUC'];
        $ruc = $doc->createElement('ruc', $db_ruc);
        $db_claveAcceso = $_SESSION['Clave Acceso'];
        $claveAcceso = $doc->createElement('claveAcceso', $db_claveAcceso);
        $db_codDoc = $_SESSION['Tipo Documento'];
        $codDoc = $doc->createElement('codDoc', $db_codDoc);
        $db_estab = $_SESSION['Establecimiento'];
        $estab = $doc->createElement('estab', $db_estab);
        $db_ptoEmi = $_SESSION['Punto'];
        $ptoEmi = $doc->createElement('ptoEmi', $db_ptoEmi);
        $db_secuencial = "";
        $secuencial = $doc->createElement('secuencial', $db_secuencial);
        $db_dirMatriz = $_SESSION['Direccion Matriz'];
        $dirMatriz = $doc->createElement('dirMatriz', $db_dirMatriz);
        $db_codigo = "";
        $codigo = $doc->createElement('codigo', $db_codigo);
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
        $infoTributaria->appendChild($codigo);
/*
 *      Aqui esta el proceso de todas las facturas
 */
$sql = "select i.TxnID, i.TxnDate, l.IDKEY, l.ItemRef_FullName from invoice i join invoicelinedetail l on i.TxnID = l.IDKEY where i.TxnDate = \'2014-07-01\'";
        $db_infoFactura = "";
        $infoFactura = $doc->createElement('infoFactura', $db_infoFactura);

        $db_fechaEmision = $db_TxnDate;
        $fechaEmision = $doc->createElement('fechaEmision', $db_fechaEmision);
        $db_dirEstablecimiento = $db_BillAddress_Addr1;
        $dirEstablecimiento = $doc->createElement('dirEstablecimiento', $db_dirEstablecimiento);
        $db_contribuyenteEspecial = "";
        $contribuyenteEspecial = $doc->createElement('contribuyenteEspecial', $db_contribuyenteEspecial);
        $db_obligadoContabilidad = "SI";
        $obligadoContabilidad = $doc->createElement('obligadoContabilidad', $db_obligadoContabilidad);
        $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
        $tipoIdentificacionComprador = $doc->createElement('tipoIdentificacionComprador', $db_tipoIdentificacionComprador);
        $db_razonSocialComprador = $db_CustomerRef_FullName;
        $razonSocialComprador = $doc->createElement('razonSocialComprador', $db_razonSocialComprador);
        $db_identificacionComprador = $db_BillAddress_Addr3; // addr3 esta el RUC
        $identificacionComprador = $doc->createElement('identificacionComprador', $db_identificacionComprador);
        $db_totalSinImpuestos = $db_AppliedAmount - $db_SalesTaxTotal;
        $totalSinImpuestos = $doc->createElement('totalSinImpuestos', $db_totalSinImpuestos);
        $db_totalDescuento = 0;
        $totalDescuento = $doc->createElement('totalDescuento', $db_totalDescuento);
        $db_totalConImpuestos = $db_AppliedAmount;
        $totalConImpuestos = $doc->createElement('totalConImpuestos', $db_totalConImpuestos);

        /*
          Una factura puede tener mas de un impuesto
         */
        $db_totalImpuesto = $db_SalesTaxTotal;
        $totalImpuesto = $doc->createElement('totalImpuesto', $db_totalImpuesto);

        $codigo = $doc->createElement('codigo', $db_codigo);

        $db_codigoPorcentaje = "";
        $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $db_codigoPorcentaje);

        $db_baseImponible = "";
        $baseImponible = $doc->createElement('baseImponible', $db_baseImponible);

        $db_valor = "";
        $valor = $doc->createElement('valor', $db_valor);

        $totalImpuesto->appendChild($codigo);
        $totalImpuesto->appendChild($codigoPorcentaje);
        $totalImpuesto->appendChild($baseImponible);
        $totalImpuesto->appendChild($valor);

        $totalConImpuestos->appendChild($totalImpuesto);

        $db_propina = "";
        $propina = $doc->createElement('propina', $db_propina);
        $db_importeTotal = $db_AppliedAmount;
        $importeTotal = $doc->createElement('importeTotal', $db_importeTotal);
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

        $db_detalles = "";
        $detalles = $doc->createElement('detalles', $db_detalles);

        /*
          Esto es por cada producto
         */
    $sql1 .= "SELECT FROM invoiceline where IDKEY=?";
    $stmt1 = $db->prepare($sql) or die(mysqli_error($db));
    $selec = $db_TxnID;
    $stmt1->bind_param("s", $selec);
    $flag = "*** ERROR no existe relacion de los productos con las facturas Seleccionadas";
    $stmt1->execute();
    $stmt1->bind_result();        /* fetch values */

     while ($stmt1->fetch()) {
        $db_detalle = "";
        $detalle = $doc->createElement('detalle', $db_detalle);

        $db_codigoPrincipal = "";
        $codigoPrincipal = $doc->createElement('codigoPrincipal', $db_codigoPrincipal);
        $db_descripcion = "";
        $descripcion = $doc->createElement('descripcion', $db_descripcion);
        $db_cantidad = "";
        $cantidad = $doc->createElement('cantidad', $db_cantidad);
        $db_precioUnitario = "";
        $precioUnitario = $doc->createElement('precioUnitario', $db_precioUnitario);
        $db_descuento = "";
        $descuento = $doc->createElement('descuento', $db_descuento);
        $db_precioTotalSinImpuesto = "";
        $precioTotalSinImpuesto = $doc->createElement('precioTotalSinImpuesto', $db_precioTotalSinImpuesto);

        $db_impuestos = "";
        $impuestos = $doc->createElement('impuestos', $db_impuestos);

        /*
          Puede haber mas de un impuesto por el mismo producto
         */
        $db_impuesto = "";
        $impuesto = $doc->createElement('impuesto', $db_impuesto);

        $codigo = $doc->createElement('codigo', $db_codigo);
        $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $db_codigoPorcentaje);
        $db_tarifa = "";
        $tarifa = $doc->createElement('tarifa', $db_tarifa);
        $baseImponible = $doc->createElement('baseImponible', $db_baseImponible);
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
     }
        $db_infoAdicional = "";
        $infoAdicional = $doc->createElement('infoAdicional', $db_infoAdicional);

        $db_campoAdicional = "";
        $campoAdicional = $doc->createElement('campoAdicional', $db_campoAdicional);
        $campoAdicionalATTR = $doc->createElement('nombre');
        $campoAdicionalATTR->value = "Direccion";
        $campoAdicional->appendChild($campoAdicionalATTR);

        $campoAdicional = $doc->createElement('campoAdicional', $db_campoAdicional);
        $campoAdicionalATTR = $doc->createElement('Email');
        $campoAdicionalATTR->value = "jrcscarrillo@gmail.com";
        $campoAdicional->appendChild($campoAdicionalATTR);

        $factura->appendChild($infoAdicional);
        $factura->appendChild($detalles);
        $factura->appendChild($infoFactura);
        $factura->appendChild($infoTributaria);

        $root->appendChild($factura);
    }
    $doc->appendChild($root);
    $doc->save("../tmp/$archivo");
    /* close statement */
    $stmt->close();
    $db->close();
    generaArchivo($archivo);
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
