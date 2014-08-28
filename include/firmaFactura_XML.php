<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Agosto 22, 2014
 * 
 * Proyecto: Comprobantes Electronicos
 * Version: 2.0
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
//    traverseDocument( $doc );
include 'conectaQuickBooks.php';
include 'claveAcceso.php';
include 'cambiaString.php';
include '../utilitarios/mergeFacturas.php';
include '../utilitarios/mergeComprobantes.php';
include '../utilitarios/initFacturas.php';

    inicializaC();
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
        echo 'Lee Factura => ' . $db_RefNumber;
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
             inicializaF();
             inicializaD();
             }
        if ($control != $db_RefNumber) {
             $retornaDOM = totalFactura();
             juntaFacturas();
//             echo 'sigue';
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
             inicializaF();
             inicializaD();
//             traverseDocument( $doc );
        } 
        if ($db_Item != NULL) {
//            echo 'Lee Producto => ' . $db_Item;
             $retornaDOM = procesaItem();
//             traverseDocument( $doc );
         } 
    }
    if ($control != 0) {
        $retornaDOM = totalFactura();
        juntaFacturas();
    }
    
    $param = $_POST['archivo'] . '.xml';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    $doc1 = new DOMDocument();
    $doc1->formatOutput = TRUE;
    $root = $doc1->createElement('lote-masivo');
    $ambiente = $doc1->createElement('ambiente', $_SESSION['ambiente']);
    $tipoEmision = $doc1->createElement('tipoEmision', $_SESSION['emision']);
    $ruc = $doc1->createElement('ruc', $_SESSION['Ruc']);
    $claveAcceso = $doc1->createElement('claveAcceso', $db_claveAcceso1);
    $db_codDoc = '01';
    $codDoc = $doc1->createElement('codDoc', $db_codDoc);
    $db_estab = $_SESSION['establecimiento'];
    $estab = $doc1->createElement('estab', $db_estab);
    $root->appendChild($ambiente);
    $root->appendChild($tipoEmision);
    $root->appendChild($ruc);
    $root->appendChild($claveAcceso);
    $root->appendChild($estab);
    $root->appendChild($codDoc);
    $doc1->appendChild($root);
    $doc1->save($salida);
    juntaComprobantes();
    /* close statement */
    $stmt->close();
    $db->close();
    generaArchivo($salida);
    exit();
} 

function totalFactura() {
    global $doc, $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $db_claveAcceso1, $wk_RefNumber, $wk_Name, $wk_Ruc, $wk_TxnDate, $wk_Item, $wk_descripcion, $wk_Quantity, $wk_Rate, $wk_Amount, $wk_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa, $regresaRuc;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $doc->load('factura.xml');
    $factura = $doc->getElementsByTagName('factura')->item(0);
    $root = $doc->getElementsByTagName('comprobante')->item(0);
//    var_dump($db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo);
    var_dump($wk_RefNumber, $wk_Name, $wk_Ruc, $wk_TxnDate, $wk_Item, $wk_descripcion, $wk_Quantity, $wk_Rate, $wk_Amount, $wk_Campo);
    
    $infoFactura = $doc->createElement('infoFactura');
    $fechaEmision = $doc->createElement('fechaEmision', $wk_TxnDate);
    $dirEstablecimiento = $doc->createElement('dirEstablecimiento', $_SESSION['emisor']);
    $contribuyenteEspecial = $doc->createElement('contribuyenteEspecial', $_SESSION['resolucion']);
    $obligadoContabilidad = $doc->createElement('obligadoContabilidad', $_SESSION['contabilidad']);
    $db_tipoIdentificacionComprador = "04"; // ruc 04 cedula 05 pasaporte 06 consumidor final 07
    if ($wk_Ruc == '9999999999999') {
        $db_tipoIdentificacionComprador = "07";
    } else {
        if (strlen($wk_Ruc) == 10) {
            $db_tipoIdentificacionComprador = "05";    
        }
    }
        
    $tipoIdentificacionComprador = $doc->createElement('tipoIdentificacionComprador', $db_tipoIdentificacionComprador);
    $razonSocialComprador = $doc->createElement('razonSocialComprador', $wk_Name);
    $identificacionComprador = $doc->createElement('identificacionComprador', $regresaRuc);
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
        
$facturaBase = 0;
$facturaValorImp = 0;
$facturaSinImp = 0;
$facturaDesc = 0;
$facturaTotal = 0;
    
    $infoTributaria = $doc->createElement('infoTributaria');
    $ambiente = $doc->createElement('ambiente', $_SESSION['ambiente']);
    $tipoEmision = $doc->createElement('tipoEmision', $_SESSION['emision']);
    $razonSocial = $doc->createElement('razonSocial', $_SESSION['Razon']);
    $nombreComercial = $doc->createElement('nombreComercial', $_SESSION['Comercial']);
    $ruc = $doc->createElement('ruc', $_SESSION['Ruc']);
    
    $db_claveAcceso = crea_clave();
    $db_claveAcceso1 = implode($db_claveAcceso);
    $claveAcceso = $doc->createElement('claveAcceso', $db_claveAcceso1);
        $db_codDoc = '01';
        $codDoc = $doc->createElement('codDoc', $db_codDoc);
        $db_estab = $_SESSION['establecimiento'];
        $estab = $doc->createElement('estab', $db_estab);
        $db_ptoEmi = $_SESSION['puntoemision'];
        $ptoEmi = $doc->createElement('ptoEmi', $db_ptoEmi);
        
        $secuencial = $doc->createElement('secuencial', $wk_RefNumber);
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

        $factura->appendChild($infoTributaria);
        $factura->appendChild($infoFactura);
        $root->appendChild($factura);
        $doc->appendChild($root);
        $doc->save('factura.xml');
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
    var_dump($args);
    $claveArray = generaClave($args);
    echo 'Esta es la resultante ';
    var_dump($claveArray);
    return $claveArray;
}
function procesaItem() {
    global $db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo;
    global $fijoCodImp, $fijoPorcentaje, $fijoTarifa;
    global $facturaBase, $facturaDesc, $facturaSinImp, $facturaTotal, $facturaValorImp;
//    var_dump($db_RefNumber, $db_Name, $db_Ruc, $db_TxnDate, $db_Item, $db_descripcion, $db_Quantity, $db_Rate, $db_Amount, $db_Campo);
    $doc = new DOMDocument();
    $doc->formatOutput = TRUE;
    $doc->load('detalles.xml');
    $root = $doc->getElementsByTagName('detalles')->item(0);
    
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
    $db_valor = $db_Amount * $fijoPorcentaje / 100;
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

    $root->appendChild($detalle);
    $doc->appendChild($root);
    $doc->save('detalles.xml');
    
    $facturaBase = $facturaBase + $db_Amount;
    $facturaValorImp = $facturaValorImp + $db_valor;
    $facturaSinImp = $facturaSinImp + $db_Amount;
    $facturaDesc = 0;
    $facturaTotal = $facturaTotal + $db_Amount + $db_valor;
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
            echo "Archivo adicionado:" . $wk_nombre . "\r\n";
        } else {
            echo "error archivo no se adiciono\r\n";
        }
    }
}
function traverseDocument( $node )
{
  switch ( $node->nodeType )
  {
    case XML_ELEMENT_NODE:
      echo "Found element: \"$node->tagName\"";

      if ( $node->hasAttributes() ) {
        echo " with attributes: ";
        foreach ( $node->attributes as $attribute ) {
          echo "$attribute->name=\"$attribute->value\" ";
        }
      }

      echo "\n";
      break;

    case XML_TEXT_NODE:
      if ( trim($node->wholeText) ) {
        echo "Found text node: \"$node->wholeText\"\n";

					  


}
  break;

case XML_CDATA_SECTION_NODE:
  if ( trim($node->data) ) {
    echo "Found character data node: \"" .
    htmlspecialchars($node->data) . "\"\n";
  }
  break;

}
if ( $node->hasChildNodes() ) {
  foreach ( $node->childNodes as $child ) {
    traverseDocument( $child );
  }
 }
}