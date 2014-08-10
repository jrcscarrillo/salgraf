<?php

/*
 * Autor:   Juan Carrillo
 * Fecha:   Julio 29 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
include 'conectaBaseDatos.php';
/*
 *      1. Revisar que la sesion tenga seleccionado al contribuyente
 *      2. Revisar que se hayan seleccionados las fechas para procesar
 */
if (!isset($_SESSION['establecimiento']) or ! isset($_SESSION['puntoemision'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">' .
    "$(document).ready(function(){" .
    "$('#mensaje').text('*** ERROR No tiene seleccionado emisor');" .
    "})" .
    "</script>";
    exit();
}
if (isset($_POST['archivo'])) {
    $archivo = $_POST['archivo'];
    $flag = firmaNotaCredito($archivo);
}

function firmaNotaCredito($archivo) {
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

    $sql .= "CustomField10 from invoice where CustomField10=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $selec = "SELECCIONADA";
    $stmt->bind_param("s", $selec);
    $flag = "*** ERROR no existen Notas de Credito Seleccionadas";
    $stmt->execute();
    $stmt->bind_result($db_TxnID, $db_TimeCreated, $db_TimeModified, $db_EditSequence, $db_TxnNumber, $db_CustomerRef_ListID, $db_CustomerRef_FullName, $db_TxnDate, $db_RefNumber, $db_BillAddress_Addr1, $db_BillAddress_Addr2, $db_BillAddress_Addr3, $db_BillAddress_City, $db_Subtotal, $db_SalesTaxPercentaje, $db_SalesTaxTotal, $db_AppliedAmount, $db_CustomField10);        /* fetch values */
    /*
     * DOMDocument es el nombre del objetgo para crear un archivo XML
     * Despues se utiliza la forma de PHP de generar tags en XML
     */
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('NotasCredito');
    $notaCredito = $doc->createElement('notaCredito');
    /*
     *      Se procesan todas las notas de credito que tienen en el campo del usuario de la tabla de invoices del QB
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

        $infoTributaria->appendChild($ambiente);
        $infoTributaria->appendChild($tipoEmision);
        $infoTributaria->appendChild($razonSocial);
        $infoTributaria->appendChild($nombreComercial);
        $infoTributaria->appendChild($ruc);
        $infoTributaria->appendChild($claveAcceso);
        $infoTributaria->appendChild($codDoc);
        $infoTributaria->appendChild($estab);
        $infoTributaria->appendChild($ptoEmi);
        $infoTributaria->appendChild($secuencial);
        $infoTributaria->appendChild($dirMatriz);
        /*
         *      Aqui esta el proceso de todas las notas de credito
         */
        $db_infoNotaCredito = "";
        $infoNotaCredito = $doc->createElement('infoNotaCredito', $db_infoNotaCredito);

        $db_fechaEmision = "";
        $fechaEmision = $doc->createElement('fechaEmision', $db_fechaEmision);
        $db_dirEstablecimiento = "";
        $dirEstablecimiento = $doc->createElement('dirEstablecimiento', $db_dirEstablecimiento);
        $db_tipoIdentificacionComprador = "";
        $tipoIdentificacionComprador = $doc->createElement('tipoIdentificacionComprador', $db_tipoIdentificacionComprador);
        $db_razonSocialComprador = "";
        $razonSocialComprador = $doc->createElement('razonSocialComprador', $db_razonSocialComprador);
        $db_identificacionComprador = "";
        $identificacionComprador = $doc->createElement('identificacionComprador', $db_identificacionComprador);
        $db_contribuyenteEspecial = "";
        $contribuyenteEspecial = $doc->createElement('contribuyenteEspecial', $db_contribuyenteEspecial);
        $db_obligadoContabilidad = "";
        $obligadoContabilidad = $doc->createElement('obligadoContabilidad', $db_obligadoContabilidad);

        $db_codDocModificado = "";
        $codDocModificado = $doc->createElement('codDocModificado', $db_codDocModificado);
        $db_numDocModificado = "";
        $numDocModificado = $doc->createElement('numDocModificado', $db_numDocModificado);
        $db_fechaEmisionDocSustento = "";
        $fechaEmisionDocSustento = $doc->createElement('fechaEmisionDocSustento', $db_fechaEmisionDocSustento);
        $db_totalSinImpuestos = "";
        $totalSinImpuestos = $doc->createElement('totalSinImpuestos', $db_totalSinImpuestos);
        $db_valorModificacion = "";
        $valorModificacion = $doc->createElement('valorModificacion', $db_valorModificacion);
        $db_moneda = "";
        $moneda = $doc->createElement('moneda', $db_moneda);

        /*
          Una nota de credito puede tener mas de un impuesto
         */
        $db_totalImpuesto = "";
        $totalImpuesto = $doc->createElement('totalImpuesto', $db_totalImpuesto);
        $db_codigo = "";
        $codigo = $doc->createElement('codigo', $db_codigo);
        $db_codigoPorcentaje = "";
        $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $db_codigoPorcentaje);
        $db_baseImponible = "";
        $baseImponible = $doc->createElement('baseImponible', $db_baseImponible);
        $db_valor = "";
        $valor = $doc->createElement('valor', $db_valor);

        $totalConImpuesto->appendChild($codigo);
        $totalConImpuesto->appendChild($orcentaje);
        $totalConImpuesto->appendChild($baseImponible);
        $totalConImpuesto->appendChild($valor);

        $totalConImpuestos->appendChild($totalConImpuesto);

        $infoNotaCredito->appendChild($fechaEmision);
        $infoNotaCredito->appendChild($direccionEstablecimiento);
        $infoNotaCredito->appendChild($tipoIdentificacionComprador);
        $infoNotaCredito->appendChild($razonSocialComprador);
        $infoNotaCredito->appendChild($identificacionComprador);

        $infoNotaCredito->appendChild($contribuyenteEspecial);
        $infoNotaCredito->appendChild($obligadoContabilidad);
        $infoNotaCredito->appendChild($codDocModificado);
        $infoNotaCredito->appendChild($numDocModificado);
        $infoNotaCredito->appendChild($fechaEmisionDocSustento);
        $infoNotaCredito->appendChild($totalSinImpuestos);
        $infoNotaCredito->appendChild($valorModificacion);
        $infoNotaCredito->appendChild($moneda);

        $db_detalles = "";
        $detalles = $doc->createElement('detalles', $db_detalles);

        /*
          Esto es por cada producto
         */
        $db_detalle = "";
        $detalle = $doc->createElement('detalle', $db_detalle);

        $db_codigoInterno = "";
        $codigoInterno = $doc->createElement('codigoInterno', $db_codigoInterno);
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

        $db_codigo = "";
        $codigo = $doc->createElement('codigo', $db_codigo);
        $db_codigoPorcentaje = "";
        $codigoPorcentaje = $doc->createElement('codigoPorcentaje', $db_codigoPorcentaje);
        $db_tarifa = "";
        $tarifa = $doc->createElement('tarifa', $db_tarifa);
        $db_baseImponible = "";
        $baseImponible = $doc->createElement('baseImponible', $db_baseImponible);
        $db_valor = "";
        $valor = $doc->createElement('valor', $db_valor);
        $impuesto->appendChild( $codigo );
        $impuesto->appendChild( $codigoPorcentaje );
        $impuesto->appendChild( $tarifa );
        $impuesto->appendChild( $baseImponible );
        $impuesto->appendChild( $valor );

        $impuestos->appendChild( $impuesto );

        $detalle->appendChild( $codigoInterno );
        $detalle->appendChild( $descripcion );
        $detalle->appendChild( $cantidad );
        $detalle->appendChild( $precioUnitario );
        $detalle->appendChild( $descuento );
        $detalle->appendChild( $precioTotalSinImpuesto );
        $detalle->appendChild( $impuestos );

        $detalles->appendChild( $detalle );

        $db_infoAdicional = "";
        $infoAdicional = $doc->createElement('infoAdicional', $db_infoAdicional);

        $db_campoAdicional = "";
        $campoAdicional = $doc->createElement('campoAdicional', $db_campoAdicional);
        $campoAdicionalATTR = $doc->createElement('nombre');
        $campoAdicionalATTR->value = "Direccion";
        $campoAdicional->appendChild($campoAdicionalATTR);

        $infoAdicional->appendChild($campoAdicional);

        $db_campoAdicional = "";
        $campoAdicional = $doc->createElement('campoAdicional', $db_campoAdicional);
        $campoAdicionalATTR = $doc->createElement('Email');
        $campoAdicionalATTR->value = "jrcscarrillo@gmail.com";
        $campoAdicional->appendChild($campoAdicionalATTR);

        $infoAdicional->appendChild($campoAdicional);

        $notaCredito->appendChild( $infoAdicional );
        $notaCredito->appendChild( $detalles );
        $notaCredito->appendChild( $infoFactura );
        $notaCredito->appendChild( $infoTributaria );

        $root->appendChild( $notaCredito );
    }
    $doc->appendChild( $root );
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
