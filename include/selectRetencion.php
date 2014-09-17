<html>
        <head>
        <title>Aurora Mensajes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../css/demo.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/sky-forms.css">
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/sky-forms-ie8.css">
        <![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../js/jquery.form.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.js"></script>
        <script src="../js/jquery.modal.js"></script>
        <style>
            #mensaje {
                color: orange;
                text-align: center;
                font-family: "Times New Roman";
                font-size: 20px;
            }
        </style>
        <!--[if lt IE 10]>
        <script src="../js/jquery.placeholder.min.js"></script>
        <![endif]-->		
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="../js/sky-forms-ie8.js"></script>
        <![endif]-->
    </head>
    <?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Septiembre 10, 2014
 * Proyecto: Comprobantes Electronicos
 */
//var_dump($GLOBALS);
    session_start();
    include_once 'cambiaString.php';
if (!isset($_SESSION['carrillosteam'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR Usuario no ha ingresado al sistema');".
        "})".
        "</script>";
        exit();
}
    /*
     *  Se controla que en la sesion este presente el usuario con la autorizacion
     *  y tambien que haya seleccionado el contribuyente que facturara
     */
if (!isset($_SESSION['establecimiento']) or !isset($_SESSION['puntoemision'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR No ha seleccionado Contribuyente');".
        "})".
        "</script>";
        exit();
}

if (!isset($_POST['start']) or !isset($_POST['finish'])) {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR NO Tiene seleccionadas fechas de proceso');".
        "})".
        "</script>";
        exit();    
}
    include 'conectaQuickBooks.php';
    $wk_start = $_POST['start'];
    $wk_finish = $_POST['finish'];
    $inicioDB = strtotime($wk_start);
    $finDB = strtotime($wk_finish);
//    echo "Fecha con strtotime : " . $inicioDB;
    $_SESSION['fechaInicio'] = date('Y-m-d', $inicioDB);
    $_SESSION['fechaFin'] = date('Y-m-d', $finDB);
//    echo "Fecha con date : " . $inicio;
    $flagDB = updateRetencion();
    if ($flagDB == 'OK Se Actualizaron las retenciones seleccionadas') {
        $flagDB = chkRetencion();
    }?>
        <body class="bg-cyan">
        <div class="body body-s">		
            <form action="../index.html" id="sky-form" class="sky-form">
                <header>Continuar</header>
                <fieldset>
                    <section>
                        <div class="row" id="mensaje"><?php echo $flagDB?></div>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="button">Continuar</button>
                </footer>
            </form>			
        </div>
    </body>
<?php 
    exit();?>
    
<?php
function chkRetencion() {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }

    $sql = "select TxnID, VendorRef_FullName, TxnDate, RefNumber, ";
    $sql .= "CreditAmount, Memo, CustomField15";
    $sql .= " from vendorcredit where CustomField15 =? and CreditAmount > 0 and TxnDate >=? and TxnDate <=? ORDER BY RefNumber";
    
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    
    $wk_seleccionada = "SELECCIONADA";
        
    $stmt->bind_param("sss", $wk_seleccionada, $_SESSION['fechaInicio'], $_SESSION['fechaFin']);
    $stmt->execute();
    $stmt->bind_result($wk_TxnID, $wk_VendorRefFullName, $wk_TxnDate, $wk_RefNumber, $wk_CreditAmount, $wk_Memo, $wk_CustomField15 );        /* fetch values */
    $wk_NumeroRetenciones = 0;
    $wk_ValorRetenciones = 0;
    $wk_TotalTotal = 0;
    $wk_hoy = date("F j, Y, g:i a"); 
/*
 *  1. Genera el nombre del archivo a grabar
 *  2. Copia el template de las facturas
 *  3. Genera un DOMDocument 
 */
    $param = $_SESSION['nombre'] . $_SESSION['fechaInicio'] . '.html';
    $directorio = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . 'retencionesScroll.html';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    copy($directorio, $salida);
    $doc = new DOMDocument();
    $doc->loadHTMLFile($salida);
    $E_cliente = $doc->getElementById('cliente');
    $E_fecha = $doc->getElementById('fecha');
    $E_numero = $doc->getElementById('numero');
    $E_memo = $doc->getElementById('memo');
    $E_retencion = $doc->getElementById('retencion');
    
/*
 *   1. Procesa cada factura
 *   2. Es posible cambiar los totales con la opcion sum
 */
    while ($stmt->fetch()) {

    $out_retencion = number_format($wk_CreditAmount, 2, ',', ' ');
    $regresaName = limpiaString($wk_VendorRefFullName);
    $uno = $doc -> createElement('p', $regresaName);
    $dos = $doc -> createElement('p', $wk_TxnDate);
    $tres = $doc -> createElement('p', $wk_RefNumber);
    $cuatro = $doc -> createElement('p', $wk_Memo);
    $cinco = $doc -> createElement('p', $out_retencion);

    $E_cliente -> appendChild($uno);
    $E_fecha -> appendChild($dos);
    $E_numero -> appendChild($tres);
    $E_memo -> appendChild($cuatro);
    $E_retencion -> appendChild($cinco);
    $wk_TotalTotal = $wk_TotalTotal + $wk_CreditAmount;
    $wk_NumeroRetenciones ++;
        
  }
    $unof = $doc -> createElement('h2', 'Retenciones Seleccionadas');
    $out_debe = number_format($wk_TotalTotal, 2, ',', ' ');
    $wk_blanco = "  ";
    $dosf = $doc -> createElement('p', $wk_blanco);
    $tresf = $doc -> createElement('p', $wk_blanco);
    $cuatrof = $doc -> createElement('p', $wk_NumeroRetenciones);
    $cincof = $doc -> createElement('p', $out_debe);
    
    $E_cliente -> appendChild($unof);
    $E_fecha -> appendChild($dosf);
    $E_numero -> appendChild($tresf);
    $E_memo -> appendChild($cuatrof);
    $E_retencion -> appendChild($cincof);
    
    $doc->saveHTMLFile($salida);
    $flagEmail = enviaRetencionesSeleccionadas($param);
    
    /* close statement */
    $stmt->close();
    $db->close();
    
    return $flagEmail;;
 }

function updateRetencion() {
//    var_dump($fechaInicio, $fechaFin);
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE vendorcredit SET CustomField15 = 'SELECCIONADA' where TxnDate >=? and TxnDate <= ? and CustomField15 is null";
//    $sql = "UPDATE invoice SET CustomField15 = 'SELECCIONADA' LIMIT 40";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
//   $seleccionada = NULL;
    $stmt->bind_param("ss", $_SESSION['fechaInicio'], $_SESSION['fechaFin']);
    $flag = "No se proceso Actualizacion de retenciones seleccionadas";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $flag = "*** ERROR No se han seleccionado retenciones " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $flag = 'OK Se Actualizaron las retenciones seleccionadas';
    }
        /* close statement */
    $stmt->close();
    
    return $flag;
}
function enviaRetencionesSeleccionadas($param) {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
//    $directorio = 'http://serverml110/salgraf/archivos/' . $param;
    $directorio = 'file:///C:/wamp/www/Salgraf/archivos/' . $param;
    $part = '<html><head></head><body><div><b>Nombre: </b>' . $_SESSION['nombre'] . '<br><b>Apellido: </b>' . $_SESSION['apellido'] . '<br>';
    $part .= '<br><hr><br><span>Usted puede ir a esta direccion para ver el archivo </span>';
    $part .= '<br><hr><br><span>' .$directorio . '</sapn><br><br><span>Copie este link en una nueva ventana de su buscador favorito</span></div></body></html>';

    $body = 'Nombre: ' . $_SESSION['nombre'] . 'Apellido: ' . $_SESSION['apellido'] . "\r\n";
    $body .= 'Usted esta ahbilitado para utilizar el sistema de comprobantes electronicos\r\n';
    $body .= $directorio . ' Ver el archivo \r\n ';
    
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Retenciones Seleccionadas';
    $paraemail['fromemail']['email'] = 'salgraf.sistema@gmail.com';
    $paraemail['fromemail']['nombre'] = 'Sistema';
    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'].' '.$_SESSION['apellido'];
    
    $flagEmail = enviamail($paraemail);
    if ($flagEmail == "Sent") {
    $flagEmail = 'OK Se Actualizaron las retenciones seleccionadas, y se envio el email';
        
    } else {
        $flagEmail = 'OK Se Actualizaron las retenciones seleccionadas no se pudo enviar email';
    
    } 
    
    return $flagEmail;
}
?>
</html>