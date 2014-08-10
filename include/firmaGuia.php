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
    $flag = firmaGuia($archivo);
}

function firmaGuia($archivo) {
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
    $flag = "*** ERROR no existen Guias Seleccionadas";
    $stmt->execute();
    $stmt->bind_result($db_TxnID, $db_TimeCreated, $db_TimeModified, $db_EditSequence, $db_TxnNumber, $db_CustomerRef_ListID, $db_CustomerRef_FullName, $db_TxnDate, $db_RefNumber, $db_BillAddress_Addr1, $db_BillAddress_Addr2, $db_BillAddress_Addr3, $db_BillAddress_City, $db_Subtotal, $db_SalesTaxPercentaje, $db_SalesTaxTotal, $db_AppliedAmount, $db_CustomField10);        /* fetch values */
    /*
     * DOMDocument es el nombre del objetgo para crear un archivo XML
     * Despues se utiliza la forma de PHP de generar tags en XML
     */
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('Guia');
    
    /*
     *      Se procesan todas las notas de debito que tienen en el campo del usuario de la tabla de invoices del QB
     *      el estado SELECCIONADA
     */
    while ($stmt->fetch()) {

        /*
         *      Informacion del Emisor
         */
$db_guiaRemision = "";
$guiaRemision = $doc -> createElement( 'guiaRemision', $db_guiaRemision );
$db_infoTributaria = " ";
   $infoTributaria = $doc -> createElement('infoTributaria', $db_infoTributaria);
    $db_ambiente = " ";
       $ambiente = $doc -> createElement('ambiente', $db_ambiente );
       
       $db_tipoEmision = " ";
	$tipoEmision = $doc -> createElement('tipoEmision', $db_tipoEmision );
	$db_razonSocial = " ";
	$razonSocial = $doc -> createElement('razonSocial', $db_razonSocial );
	$db_nombreComercial = " ";
	$nombreComercial = $doc -> createElement('nombreComercial', $db_nombreComercial );
	$db_ruc = " ";
	$ruc = $doc -> createElement('ruc', $db_ruc );
	$db_claveAcceso = " ";
	$claveAcceso = $doc -> createElement('claveAcceso', $db_claveAcceso );
	$db_codDoc = " ";
	$codDoc = $doc -> createElement('codDoc', $db_codDoc );
	$db_estab = " ";
	$estab = $doc -> createElement('estab', $db_estab );
	$db_ptoEmi = " ";
	$ptoEmi = $doc -> createElement('ptoEmi', $db_ptoEmi);
	$db_secuencial = " ";
	$secuencial = $doc -> createElement('secuencial', $db_secuencial);
	$db_dirMatriz = " ";
	$dirMatriz = $doc -> createElement('dirMatriz', $db_dirMatriz);
	
$infoTributaria->appendChild( $ambiente );
$infoTributaria->appendChild( $tipoEmision );
$infoTributaria->appendChild( $razonSocial );
$infoTributaria->appendChild( $nombreComercial );
$infoTributaria->appendChild( $ruc );
$infoTributaria->appendChild( $claveAcceso );
$infoTributaria->appendChild( $codDoc );
$infoTributaria->appendChild( $estab );
$infoTributaria->appendChild( $ptoEmi );
$infoTributaria->appendChild( $secuencial );
$infoTributaria->appendChild( $dirMatriz );

$db_infoGuiaRemision = "";
$infoGuiaRemision = $doc -> createElement( 'infoGuiaRemision', $db_infoGuiaRemision );
        $db_dirEstablecimiento = "";
        $dirEstablecimiento = $doc -> createElement( 'dirEstablecimiento', $db_dirEstablecimiento );
        $db_dirPartida = "";
        $dirPartida = $doc -> createElement( '$db_dirPartida', $db_dirPartida );
        $db_razonSocialTransportista = "";
        $razonSocialTransportista = $doc -> createElement( 'razonSocialTransportista', $db_razonSocialTransportista );
        $db_tipoIdentificacionTransportista = "";
        $tipoIdentificacionTransportista = $doc -> createElement( 'tipoIdentificacionTransportista', $db_tipoIdentificacionTransportista );
        $db_rucTransportista = "";
        $rucTransportista = $doc -> createElement( 'rucTransportista ', $db_rucTransportista );
        $db_obligadoContabilidad = "";
        $obligadoContabilidad = $doc -> createElement( 'obligadoContabilidad', $db_obligadoContabilidad );
        $db_contribuyenteEspecial = "";
        $contribuyenteEspecial = $doc -> createElement( 'contribuyenteEspecial', $db_contribuyenteEspecial );
        $db_fechaIniTransporte = "";
        $fechaIniTransporte = $doc -> createElement( 'fechaIniTransporte ', $db_fechaIniTransporte );
        $db_fechaFinTransporte = "";
        $fechaFinTransporte = $doc -> createElement( 'fechaFinTransporte', $db_fechaFinTransporte );
        $db_placa = "";
        $placa = $doc -> createElement( 'placa ', $db_placa );
 
 $infoGuiaRemision ->appendChild( $dirEstablecimiento );  
 $infoGuiaRemision ->appendChild( $dirPartida );
 $infoGuiaRemision ->appendChild( $razonSocialTransportista );
 $infoGuiaRemision ->appendChild( $tipoIdentificacionTransportista );
 $infoGuiaRemision ->appendChild( $rucTransportista );
$infoGuiaRemision ->appendChild( $obligadoContabilidad );
$infoGuiaRemision ->appendChild( $contribuyenteEspecial );
$infoGuiaRemision ->appendChild( $fechaIniTransporte );
$infoGuiaRemision ->appendChild( $fechaFinTransporte );
$infoGuiaRemision ->appendChild( $placa );

    $db_destinatarios = "";
     $destinatarios = $doc -> createElement( 'destinatarios', $db_destinatarios );
        $db_destinatario = "";
        $destinatario = $doc -> createElement( 'destinatario', $db_destinatario );
            $db_identificacionDestinatario = "";
            $identificacionDestinatario = $doc -> createElement( 'identificacionDestinatario', $db_identificacionDestinatario );
            $db_razonSocialDestinatario = "";
            $razonSocialDestinatario = $doc -> createElement( 'razonSocialDestinatario', $db_razonSocialDestinatario );
            $db_dirDestinatario = "";
            $dirDestinatario = $doc -> createElement( 'dirDestinatario', $db_dirDestinatario );
            $db_motivoTraslado = "";
            $motivoTraslado = $doc -> createElement( 'motivoTraslado', $db_motivoTraslado );
            $db_docAduaneroUnico = "";
            $docAduaneroUnico = $doc -> createElement( 'docAduaneroUnico', $db_docAduaneroUnico );
            $db_codEstabDestino = "";
            $codEstabDestino = $doc -> createElement( 'codEstabDestino', $db_codEstabDestino );
            $db_ruta = "";
            $ruta = $doc -> createElement( 'ruta', $db_ruta );
            $db_codDocSustento = "";
            $codDocSustento = $doc -> createElement( 'codDocSustento', $db_codDocSustento );
            $db_numDocSustento = "";
            $numDocSustento = $doc -> createElement( 'numDocSustento', $db_numDocSustento );
            $db_numAutDocSustento = "";
            $numAutDocSustento = $doc -> createElement( 'numAutDocSustento', $db_numAutDocSustento );
            $db_fechaEmisionDocSustento = "";
            $fechaEmisionDocSustento = $doc -> createElement( 'fechaEmisionDocSustento', $db_fechaEmisionDocSustento );
$destinatario -> appendChild( $identificacionDestinatario );	
$destinatario -> appendChild( $razonSocialDestinatario );
$destinatario -> appendChild( $dirDestinatario );
$destinatario -> appendChild( $motivoTraslado );
$destinatario -> appendChild( $docAduaneroUnico );
$destinatario -> appendChild( $codEstabDestino );
$destinatario -> appendChild( $ruta );
$destinatario -> appendChild( $codDocSustento );
$destinatario -> appendChild( $numDocSustento );
$destinatario -> appendChild( $numAutDocSustento );
$destinatario -> appendChild( $fechaEmisionDocSustento );

$destinatarios -> appendChild( $destinatario );
    
            $db_detalles = "";
            $detalles = $doc -> createElement( 'detalles', $db_detalles );
            $db_detalle = "";
                $detalle = $doc -> createElement( 'detalle', $db_detalle );
                    $db_codigoInterno = "";
                    $codigoInterno = $doc -> createElement( 'codigoInterno', $db_codigoInterno );
                    $db_descripcion = "";
                    $descripcion = $doc -> createElement( 'descripcion', $db_descripcion );
                    $db_cantidad = "";
                    $cantidad = $doc -> createElement( 'cantidad', $db_cantidad );
            $detalle -> appendChild( $codigoInterno );
            $detalle -> appendChild( $descripcion );
            $detalle -> appendChild( $cantidad );
            $detalles -> appendChild( $detalle);
                    
$guiaRemision -> appendChild( $infoTributaria );
$guiaRemision -> appendChild( $infoGuiaRemision);
$guiaRemision -> appendChild( $destinatarios );
$guiaRemision -> appendChild( $detalles );

	
$root ->appendChild( $guiaRemision );
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
