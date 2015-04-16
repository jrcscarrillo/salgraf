<?php

session_start();
if ($_SESSION['carrillosteam'] != 'carrillosteam') {
    require ('paraContinuar.html');
    echo '<script type="text/javascript">' .
    "$(document).ready(function(){" .
    "$('#mensaje').html('Usuario no ha ingresado al sistema');" .
    "})" .
    "</script>";
}

include 'conectaBaseDatos.php';
include_once 'paraPrince.php';
    
if (isset($_POST['nroGuiaForm'])) {
    $postGuia['numeroGuia'] = $_POST['nroGuiaForm'];
    $postGuia['fechaGuia'] = $_POST['fechaGuiaForm'];
    $postGuia['tipoIdDestino'] = $_POST['tipoIDDestinoForm'];
    $postGuia['numeroIdDestino'] = $_POST['numeroIDDestinoForm'];
    $postGuia['razon'] = $_POST['razonForm'];
    $postGuia['dirPartida'] = $_POST['dirPartidaForm'];
    $postGuia['dirDestino'] = $_POST['dirDestinoForm'];
    $postGuia['motivo'] = $_POST['motivoForm'];
    $postGuia['tipoIDTransporte'] = $_POST['tipoIDTransporteForm'];
    $postGuia['numeroIDTransporte'] = $_POST['numeroIDTransporteForm'];
    $postGuia['razonTransporte'] = $_POST['razonTransporteForm'];
    $postGuia['emailTransporte'] = $_POST['emailTransporteForm'];
    $postGuia['telTransporte'] = $_POST['telTransporteForm'];
    $postGuia['tipoDocRespaldo'] = $_POST['tipoDocRespaldoForm'];
    $postGuia['numeroDocRespaldo'] = $_POST['numeroDocRespaldoForm'];
    $postGuia['fechaDocRespaldo'] = $_POST['fechaDocRespaldoForm'];
    $postGuia['fechaInicioT'] = $_POST['fechaInicioTForm'];
    $postGuia['fechaFinT'] = $_POST['fechaFinTForm'];
    $postGuia['ruta'] = $_POST['rutaForm'];
    $postGuia['productos'] = $_POST['productosForm'];
    $postGuia['embalaje'] = $_POST['embalajeForm'];
    $postGuia['placa'] = $_POST['placaForm'];

    $_SESSION['guias'] = $postGuia;
    $param = 'guia' . $_SESSION['guias']['numeroGuia'] . '.html';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;    
    $flagDB = chkGuia();
    if ($flagDB == "Guia adicionada") {
        $flagPDF = paraPrince($salida);
//        $flagPDF = 'Genero';
        if ($flagPDF == "Genero") {
            $flagDB = "Se genero PDF de la Guia adicionada";
            $flagMail = chkMail();
            if ($flagMail == "Sent") {
                $flagDB = "Guia adicionada se envio email datos y PDF";
                } else {
                    $flagDB = "Guia adicionada NO se envio email";
                    }
        } else {
            $flagDB = "No se genero PDF de la Guia adicionada";
        }        

    }
    echo $flagDB;
}

function chkGuia() {
    global $db;
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "select * from Guias where GuiasNumero=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("i", $_SESSION['guias']['numeroGuia']);

//  $wk_idGuias, $wk_GuiasNumero, $wk_GuiasFechaEmision, $wk_GuiasTipoIdDestinatario, $wk_GuiasNumeroIdDestinatario, $wk_GuiasRazonDestinatario, $wk_GuiasDirPartida, $wk_GuiasDirDestino, $wk_GuiasMotivo, $wk_GuiasTipoIdTransportista, $wk_GuiasNumeroIdTransportista, $wk_GuiasRazonTransportista, $wk_GuiasEmailTransportista, $wk_GuiasTelTransportista, $wk_GuiasTipoDocRespaldo, $wk_GuiasNumeroDocRespaldo, $wk_GuiasFechaDocRespaldo, $wk_GuiasFechaInicioTransporte, $wk_GuiasFechaFinTransporte, $wk_GuiasRuta, $wk_GuiasProductos, $wk_GuiasEmbalaje, $wk_Guiascol

    $stmt->bind_result($wk_idGuias, $wk_GuiasNumero, $wk_GuiasFechaEmision, $wk_GuiasTipoIdDestinatario, $wk_GuiasNumeroIdDestinatario, $wk_GuiasRazonDestinatario, $wk_GuiasDirPartida, $wk_GuiasDirDestino, $wk_GuiasMotivo, $wk_GuiasTipoIdTransportista, $wk_GuiasNumeroIdTransportista, $wk_GuiasRazonTransportista, $wk_GuiasEmailTransportista, $wk_GuiasTelTransportista, $wk_GuiasTipoDocRespaldo, $wk_GuiasNumeroDocRespaldo, $wk_GuiasFechaDocRespaldo, $wk_GuiasFechaInicioTransporte, $wk_GuiasFechaFinTransporte, $wk_GuiasRuta, $wk_GuiasProductos, $wk_GuiasEmbalaje, $wk_GuiasPlaca);
    $existe = $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt->close();
        $flagNew = "No existe Guia";
        $flagNew = nuevaGuia($db);
    } else {
        $stmt->close();
        $flagNew = "Numero de Guia o Identificacion Ya Existen";
    }

    /* close statement */
    $db->close();
    return $flagNew;
}

function nuevaGuia($db) {
    $sql = "INSERT INTO guias (GuiasNumero, GuiasFechaEmision, GuiasTipoIdDestinatario, GuiasNumeroIdDestinatario, GuiasRazonDestinatario, GuiasDirPartida, GuiasDirDestino, ";
    $sql .= "GuiasMotivo, GuiasTipoIdTransportista, GuiasNumeroIdTransportista, GuiasRazonTransportista, GuiasEmailTransportista, GuiasTelTransportista, GuiasTipoDocRespaldo, ";
    $sql .= "GuiasNumeroDocRespaldo, GuiasFechaDocRespaldo, GuiasFechaInicioTransporte, GuiasFechaFinTransporte, GuiasRuta, GuiasProductos, GuiasEmbalaje, GuiasPlaca) ";
    $sql .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));

    $stmt->bind_param("isiissssiisssiisssssss", $_SESSION["guias"]['numeroGuia'] , $_SESSION["guias"]['fechaGuia'] , $_SESSION["guias"]['tipoIdDestino'] , $_SESSION["guias"]['numeroIdDestino'] , $_SESSION["guias"]['razon'] , $_SESSION["guias"]['dirPartida'] , $_SESSION["guias"]['dirDestino'] , $_SESSION["guias"]['motivo'] , $_SESSION["guias"]['tipoIDTransporte'] , $_SESSION["guias"]['numeroIDTransporte'] , $_SESSION["guias"]['razonTransporte'] , $_SESSION["guias"]['emailTransporte'] , $_SESSION["guias"]['telTransporte'] , $_SESSION["guias"]['tipoDocRespaldo'], $_SESSION["guias"]['numeroDocRespaldo'] , $_SESSION["guias"]['fechaDocRespaldo'] , $_SESSION["guias"]['fechaInicioT'] , $_SESSION["guias"]['fechaFinT'] , $_SESSION["guias"]['ruta'] , $_SESSION["guias"]['productos'] , $_SESSION["guias"]['embalaje'], $_SESSION["guias"]['placa']);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    $sql = "select * from Guias where idGuias=?";
    if ($selectTaskStmt = $db->prepare($sql)) {
        $selectTaskStmt->bind_param("i", $newId);
        $selectTaskStmt->bind_result($wk_idGuias, $wk_GuiasNumero, $wk_GuiasFechaEmision, $wk_GuiasTipoIdDestinatario, $wk_GuiasNumeroIdDestinatario, $wk_GuiasRazonDestinatario, $wk_GuiasDirPartida, $wk_GuiasDirDestino, $wk_GuiasMotivo, $wk_GuiasTipoIdTransportista, $wk_GuiasNumeroIdTransportista, $wk_GuiasRazonTransportista, $wk_GuiasEmailTransportista, $wk_GuiasTelTransportista, $wk_GuiasTipoDocRespaldo, $wk_GuiasNumeroDocRespaldo, $wk_GuiasFechaDocRespaldo, $wk_GuiasFechaInicioTransporte, $wk_GuiasFechaFinTransporte, $wk_GuiasRuta, $wk_GuiasProductos, $wk_GuiasEmbalaje, $wk_GuiasPlaca);
        $selectTaskStmt->execute();
        if ($selectTaskStmt->fetch()) {
            $flagDB = "Guia adicionada";
        } else {
            $flagDB = "error guia no se adiciono";
        }
    }
    $param = 'guia' . $_SESSION['guias']['numeroGuia'] . '.html';
    $directorio = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/bootstrap-guia.html';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;
    copy($directorio, $salida);
    $doc = new DOMDocument();
    $doc->loadHTMLFile($salida);
    $E_numeroGuia = $doc->getElementById('numeroguia');
    $E_numeroAuto = $doc->getElementById('numeroauto');
    $E_fechaEmision = $doc->getElementById('fechaemision');
    $E_motivo = $doc->getElementById('motivo');
    $E_fechaInicio = $doc->getElementById('fechainicio');
    $E_fechafin = $doc->getElementById('fechafinal');
    $E_partida = $doc->getElementById('partida');
    $E_destino = $doc->getElementById('destino');
    $E_rucdestinatario = $doc->getElementById('rucdestinatario');
    $E_destinatario = $doc->getElementById('destinatario');
    $E_ructransportista = $doc->getElementById('ructransportista');
    $E_transportista = $doc->getElementById('transportista');
    $E_ruta = $doc->getElementById('ruta');
    $E_placa = $doc->getElementById('placa');
    $E_productos = $doc->getElementsByTagName('td')->item(0);
    $E_embalaje = $doc->getElementsByTagName('td')->item(1);
    
    $uno = $doc -> createElement('p', $_SESSION['guias']['numeroGuia']);
    $dos = $doc -> createElement('p', '');
    $tres = $doc -> createElement('p', $_SESSION['guias']['fechaGuia']);
    $cuatro = $doc -> createElement('p', $_SESSION['guias']['motivo']);
    $cinco = $doc -> createElement('p', $_SESSION['guias']['fechaInicioT']);
    $seis = $doc -> createElement('p', $_SESSION['guias']['fechaFinT']);
    $siete = $doc -> createElement('p', $_SESSION['guias']['dirPartida']);
    $ocho = $doc -> createElement('p', $_SESSION['guias']['dirDestino']);
    $nueve = $doc -> createElement('p', $_SESSION['guias']['numeroIdDestino']);
    $diez = $doc -> createElement('p', $_SESSION['guias']['razon']);
    $once = $doc -> createElement('p', $_SESSION['guias']['numeroIDTransporte']);
    $doce = $doc -> createElement('p', $_SESSION['guias']['razonTransporte']);
    $trece = $doc -> createElement('p', $_SESSION['guias']['ruta']);
    $catorce = $doc -> createElement('p', $_SESSION['guias']['productos']);
    $quince = $doc -> createElement('p', $_SESSION['guias']['embalaje']);
    $diezyseis = $doc -> createElement('p', $_SESSION['guias']['placa']);
    
    $E_numeroGuia -> appendChild($uno);
    $E_numeroAuto -> appendChild($dos);
    $E_fechaEmision -> appendChild($tres);
    $E_motivo -> appendChild($cuatro);
    $E_fechaInicio -> appendChild($cinco);
    $E_fechafin -> appendChild($seis);
    $E_partida -> appendChild($siete);
    $E_destino -> appendChild($ocho);
    $E_rucdestinatario -> appendChild($nueve);
    $E_destinatario -> appendChild($diez);
    $E_ructransportista -> appendChild($once);
    $E_transportista -> appendChild($doce);
    $E_ruta -> appendChild($trece);
    $E_productos -> appendChild($catorce);
    $E_embalaje -> appendChild($quince);
    $E_placa -> appendChild($diezyseis);
    $doc->saveHTMLFile($salida);

    return $flagDB;
}

function chkMail() {

    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';

    $part = "<div><b>Numero de Guia: </b>" . $_SESSION['guias']['numeroGuia'] . "<br>";
    $part .= "<b>Fecha de la Guia: </b" . $_SESSION['guias']['fechaGuia'] . "<br>";
    $part .= "<b>Tipo de Documento Destinatario:</b>" . $_SESSION['guias']['tipoIdDestino'] . "<br>";
    $part .= "<b>Numero DocumentoDestinatario:</b>" . $_SESSION['guias']['numeroIdDestino'] . "<br>";
    $part .= "<b>Razon Social del Destinatario</b>" . $_SESSION['guias']['razon'] . "<br>";
    $part .= "<b>Direccion Partida:</b>" . $_SESSION['guias']['dirPartida'] . "<br>";
    $part .= "<br>Direccion Destino: </b>" . $_SESSION['guias']['dirDestino'] . "<br>";
    $part .= "<b>Motivo:</b>" . $_SESSION['guias']['motivo'] . "<br>";
    $part .= "<b>Tipo de identificacion: :</b>" . $_SESSION['guias']['tipoIDTransporte'] . "<br>";
    $part .= "<b>Numero Documento Transportista" . $_SESSION['guias']['numeroIDTransporte'] . "<br>";
    $part .= "<b>Razon Social::</b>" . $_SESSION['guias']['razonTransporte'] . "<br>";
    $part .= "<b>Email Transportista:</b>" . $_SESSION['guias']['emailTransporte'] . "<br>";
    $part .= "<b>Telefono Transportista:</b>" . $_SESSION['guias']['telTransporte'] . "<br>";
    $part .= "<b>Placa del Vehiculo:</b>" . $_SESSION['guias']['placa'] . "<br>";
    $part .= "<b>Tipo Documento Respaldo:</b>" . $_SESSION['guias']['tipoDocRespaldo'] . "<br>";
    $part .= "<b>Numero Documento Respaldo:</b>" . $_SESSION['guias']['numeroDocRespaldo'] . "<br>";
    $part .= "<b>Fecha Respaldo:</b>" . $_SESSION['guias']['fechaDocRespaldo'] . "<br>";
    $part .= "<b>Fecha Inicio del Transporte:</b>" . $_SESSION['guias']['fechaInicioT'] . "<br>";
    $part .= "<b>Fecha Fin del Transporte:</b>" . $_SESSION['guias']['fechaFinT'] . "<br>";
    $part .= "<b>Ruta FLota:</b>" . $_SESSION['guias']['ruta'] . "<br>";
    $part .= "<b>Descripcion Productos:</b>" . $_SESSION['guias']['productos'] . "<br>";
    $part .= "<b>Forma de embalaje:</b>" . $_SESSION['guias']['embalaje'] . "<br>";

    $part .= 'Esta guia de remision se ha adicionado correctamente';
    
    $body = "<div><b>Numero de Guia: </b>" . $_SESSION['guias']['numeroGuia'] . "<br>";
    $body .= "<b>Fecha de la Guia: </b" . $_SESSION['guias']['fechaGuia'] . "<br>";
    $body .= "<b>Tipo de Documento Destinatario:</b>" . $_SESSION['guias']['tipoIdDestino'] . "<br>";
    $body .= "<b>Numero DocumentoDestinatario:</b>" . $_SESSION['guias']['numeroIdDestino'] . "<br>";
    $body .= "<b>Razon Social del Destinatario</b>" . $_SESSION['guias']['razon'] . "<br>";
    $body .= "<b>Direccion Partida:</b>" . $_SESSION['guias']['dirPartida'] . "<br>";
    $body .= "<br>Direccion Destino: </b>" . $_SESSION['guias']['dirDestino'] . "<br>";
    $body .= "<b>Motivo:</b>" . $_SESSION['guias']['motivo'] . "<br>";
    $body .= "<b>Tipo de identificacion: :</b>" . $_SESSION['guias']['tipoIDTransporte'] . "<br>";
    $body .= "<b>Numero Documento Transportista" . $_SESSION['guias']['numeroIDTransporte'] . "<br>";
    $body .= "<b>Razon Social::</b>" . $_SESSION['guias']['razonTransporte'] . "<br>";
    $body .= "<b>Email Transportista:</b>" . $_SESSION['guias']['emailTransporte'] . "<br>";
    $body .= "<b>Telefono Transportista:</b>" . $_SESSION['guias']['telTransporte'] . "<br>";
    $body .= "<b>Numero Placa Vehiculo:</b>" . $_SESSION['guias']['placa'] . "<br>";
    $body .= "<b>Tipo Documento Respaldo:</b>" . $_SESSION['guias']['tipoDocRespaldo'] . "<br>";
    $body .= "<b>Numero Documento Respaldo:</b>" . $_SESSION['guias']['numeroDocRespaldo'] . "<br>";
    $body .= "<b>Fecha Respaldo:</b>" . $_SESSION['guias']['fechaDocRespaldo'] . "<br>";
    $body .= "<b>Fecha Inicio del Transporte:</b>" . $_SESSION['guias']['fechaInicioT'] . "<br>";
    $body .= "<b>Fecha Fin del Transporte:</b>" . $_SESSION['guias']['fechaFinT'] . "<br>";
    $body .= "<b>Ruta FLota:</b>" . $_SESSION['guias']['ruta'] . "<br>";
    $body .= "<b>Descripcion Productos:</b>" . $_SESSION['guias']['productos'] . "<br>";
    $body .= "<b>Forma de embalaje:</b>" . $_SESSION['guias']['embalaje'] . "<br>";

    $body .= 'Esta guia de remision se ha adicionado correctamente<br></div>';
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $param = 'guia' . $_SESSION['guias']['numeroGuia'] . '.pdf';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'Salgraf/' . $param;
    $paraemail['attach'] = $salida;
    $paraemail['subject'] = 'Guia de Remision Adicionada';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
//    var_dump($paraemail);
    $flagEmail = enviamail($paraemail);
    return $flagEmail;
}
