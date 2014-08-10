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
    $flag = firmaRetencion($archivo);
}

function firmaRetencion($archivo) {
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
    $flag = "*** ERROR no existen Notas de Debito Seleccionadas";
    $stmt->execute();
    $stmt->bind_result($db_TxnID, $db_TimeCreated, $db_TimeModified, $db_EditSequence, $db_TxnNumber, $db_CustomerRef_ListID, $db_CustomerRef_FullName, $db_TxnDate, $db_RefNumber, $db_BillAddress_Addr1, $db_BillAddress_Addr2, $db_BillAddress_Addr3, $db_BillAddress_City, $db_Subtotal, $db_SalesTaxPercentaje, $db_SalesTaxTotal, $db_AppliedAmount, $db_CustomField10);        /* fetch values */
    /*
     * DOMDocument es el nombre del objetgo para crear un archivo XML
     * Despues se utiliza la forma de PHP de generar tags en XML
     */
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $root = $doc->createElement('Retencion');
    
    /*
     *      Se procesan todas las notas de debito que tienen en el campo del usuario de la tabla de invoices del QB
     *      el estado SELECCIONADA
     */
    while ($stmt->fetch()) {

        /*
         *      Informacion del Emisor
         */
$db_comprobanteRetencion = " ";
$comprobanteRetencion = $doc->createElement('comprobanteRetencion', $db_comprobanteRetencion);

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

   $db_infoCompRetencion = "";
   $infoCompRetencion = $doc -> createElement( 'infoCompRetencion', $db_infoCompRetencion );
	$db_fechaEmision  = "";
	$fechaEmision = $doc -> createElement( 'fechaEmision', $db_fechaEmision );
	$db_dirEstablecimiento = "";
	$dirEstablecimiento = $doc -> createElement( 'dirEstablecimiento', $db_dirEstablecimiento );
	$db_contribuyenteEspecial = "";
	$contribuyenteEspecial = $doc -> createElement( 'contribuyenteEspecial', $db_contribuyenteEspecial );
	$db_obligadoContabilidad = "";
	$obligadoContabilidad = $doc -> createElement( 'obligadoContabilidad', $db_obligadoContabilidad );
	$db_tipoIdentificacionSujetoRetenido = "";
	$tipoIdentificacionSujetoRetenido = $doc -> createElement( 'tipoIdentificacionSujetoRetenido', $db_tipoIdentificacionSujetoRetenido );
	$db_razonSocialSujetoRetenido  = "";
	$razonSocialSujetoRetenido = $doc -> createElement( 'razonSocialSujetoRetenido', $db_razonSocialSujetoRetenido );
	$db_identificacionSujetoRetenido = "";
	$identificacionSujetoRetenido = $doc -> createElement( 'identificacionSujetoRetenido', $db_identificacionSujetoRetenido );
	$db_periodoFiscal = "";
	$periodoFiscal = $doc -> createElement( 'periodoFiscal', $db_periodoFiscal );
 
 $infoCompRetencion ->appendChild( $fechaEmision );  
 $infoCompRetencion ->appendChild( $dirEstablecimiento );
 $infoCompRetencion ->appendChild( $contribuyenteEspecial );
 $infoCompRetencion ->appendChild( $obligadoContabilidad );
 $infoCompRetencion ->appendChild( $tipoIdentificacionSujetoRetenido );
$infoCompRetencion ->appendChild( $razonSocialSujetoRetenido );
$infoCompRetencion ->appendChild( $identificacionSujetoRetenido );
$infoCompRetencion ->appendChild( $periodoFiscal );
$infoCompRetencion ->appendChild( $fechaEmision );

    $db_impuestos = "";
   $impuestos = $doc -> createElement( 'impuestos', $db_impuestos );
	$db_impuesto = "";
	$impuesto = $doc -> createElement( 'impuesto', $db_impuesto );
	    $db_codigo = "";
           $codigo = $doc -> createElement( 'codigo', $db_codigo );
	   $db_codigoRetencion = "";
	   $codigoRetencion = $doc -> createElement( 'codigoRetencion', $db_codigoRetencion );
	   $db_baseImponible = "";
	   $baseImponible = $doc -> createElement( 'baseImponible', $db_baseImponible );
	   $db_porcentajeRetener = "";
	   $porcentajeRetener = $doc -> createElement( 'porcentajeRetener', $db_porcentajeRetener );
	   $db_valorRetenido = "";
	   $valorRetenido = $doc -> createElement( 'valorRetenido', $db_valorRetenido );
	   $db_codDocSustento = "";
	   $codDocSustento = $doc -> createElement( 'codDocSustento', $db_codDocSustento );
	   $db_numDocSustento = "";
	   $numDocSustento = $doc -> createElement( 'numDocSustento', $db_numDocSustento );
	   $db_fechaEmisionDocSustento = "";
	   $fechaEmisionDocSustento = $doc -> createElement( 'fechaEmisionDocSustento', $db_fechaEmisionDocSustento );

$impuesto -> appendChild( $codigo );	
$impuesto -> appendChild( $codigoRetencion );
$impuesto -> appendChild( $baseImponible );
$impuesto -> appendChild( $porcentajeRetener );
$impuesto -> appendChild( $valorRetenido );
$impuesto -> appendChild( $codDocSustento );
$impuesto -> appendChild( $numDocSustento );
$impuesto -> appendChild( $fechaEmisionDocSustento );

$impuestos -> appendChild( $impuesto );
    
    $db_infoAdicional = "";
   $infoAdicional = $doc -> createElement( 'infoAdicional', $db_infoAdicional );
	$db_campoAdicional = "";
       $campoAdicional = $doc -> createElement( 'campoAdicional', $db_campoAdicional );

$infoAdicional -> appendChild( $campoAdicional );

$comprobanteRetencion -> appendChild( $infoAdicional );
$comprobanteRetencion -> appendChild( $impuestos );
$comprobanteRetencion -> appendChild( $infoCompRetencion );
$comprobanteRetencion -> appendChild( $infoTributaria );

	
$root ->appendChild( $comprobanteRetencion );
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
