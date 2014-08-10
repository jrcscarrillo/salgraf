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
 * Fecha:   Julio 25, 2014
 * Proyecto: Comprobantes Electronicos
 */
//var_dump($GLOBALS);
    session_start();
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
    $fechaInicio = date('Y-m-d', $inicioDB);
    $fechaFin = date('Y-m-d', $finDB);
//    echo "Fecha con date : " . $inicio;
    $flagDB = updateFactura($fechaInicio, $fechaFin);
    if ($flagDB == 'OK Se Actualizaron las facturas seleccionadas') {
        $flagDB = chkFactura($fechaInicio, $fechaFin);
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
function chkFactura($wk_start, $wk_finish) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    $sql = "select CustomerRefFullName, TxnDate, RefNumber,SalesTaxPercentage, SalesTaxTotal, AppliedAmount, BalanceRemaining, CustomField11 from invoice where TxnDate >= ? and TxnDate <= ?";
    $sql = "select TxnID, CustomerRef_FullName, TxnDate, RefNumber, ";
    $sql .= "SalesTaxPercentage, SalesTaxTotal, AppliedAmount, BalanceRemaining, CustomField11";
    $sql .= " from invoice where CustomField11 =?";
    
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    
    $wk_seleccionada = "SELECCIONADA";
    $stmt->bind_param("s", $wk_seleccionada);
    $stmt->execute();
    $stmt->bind_result($wk_TxnID, $wk_CustomerRefFullName, $wk_TxnDate, $wk_RefNumber, $wk_SalesTaxPercentage, $wk_SalesTaxTotal, $wk_AppliedAmount, $wk_BalanceRemaining, $wk_CustomField11 );        /* fetch values */
    $wk_NumeroFacturas = 0;
    $wk_ValorSinImpuestos = 0;
    $wk_TotalImpuestos = 0;
    $wk_TotalTotal = 0;
    $wk_hoy = date("F j, Y, g:i a"); 
/*
 *  1. Genera el nombre del archivo a grabar
 *  2. Copia el template de las facturas
 *  3. Genera un DOMDocument 
 */
    $param = $_SESSION['nombre'] . $wk_start . '.html';
    $directorio = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . 'facturasScroll.html';
    $salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
    copy($directorio, $salida);
    $doc = new DOMDocument();
    $doc->loadHTMLFile($salida);
    $factura = $doc->getElementById('factura');
    $totales = $doc->getElementById('totales');
    
/*
 *   1. Procesa cada factura
 *   2. Es posible cambiar los totales con la opcion sum
 */
    while ($stmt->fetch()) {

    $wk_valorFactura = $wk_AppliedAmount * -1 + $wk_BalanceRemaining;

    $lossiete = $doc->createElement('div');
    $lossiete -> setAttribute('class', 'f7 animate stack1');

    $uno = $doc -> createElement('div', $wk_CustomerRefFullName);
    $uno -> setAttribute('class', 'one');
    $dos = $doc -> createElement('div', $wk_TxnDate);
    $dos -> setAttribute('class', 'two');
    $tres = $doc -> createElement('div', $wk_RefNumber);
    $tres -> setAttribute('class', 'three');
    $cuatro = $doc -> createElement('div', $wk_SalesTaxPercentage);
    $cuatro -> setAttribute('class', 'four');
    $cinco = $doc -> createElement('div', $wk_SalesTaxTotal);
    $cinco -> setAttribute('class', 'five');
    $seis = $doc -> createElement('div', $wk_AppliedAmount);
    $seis -> setAttribute('class', 'six');
    $siete = $doc -> createElement('div', $wk_BalanceRemaining);
    $siete -> setAttribute('class', 'seven');

    $lossiete -> appendChild($uno);
    $lossiete -> appendChild($dos);
    $lossiete -> appendChild($tres);
    $lossiete -> appendChild($cuatro);
    $lossiete -> appendChild($cinco);
    $lossiete -> appendChild($seis);
    $lossiete -> appendChild($siete);

    $factura -> appendChild($lossiete);
    
        $wk_TotalImpuestos = $wk_TotalImpuestos + $wk_SalesTaxTotal;
        $wk_ValorSinImpuestos = $wk_ValorSinImpuestos + ($wk_valorFactura - $wk_SalesTaxTotal);
        $wk_TotalTotal = $wk_TotalTotal + $wk_valorFactura;
        $wk_NumeroFacturas ++;
        
  }
    $portotal = $doc->createElement('div');
    $portotal -> setAttribute('class', 'f7 animate stack1');
    $uno = $doc -> createElement('div', 'Numero de Facturas Procesadas');
    $uno -> setAttribute('class', 'one-five');
    $dos = $doc -> createElement('div', $wk_NumeroFacturas);
    $dos -> setAttribute('class', 'six-seven');
    
    $portotal -> appendChild($uno);
    $portotal -> appendChild($dos);
    
    $totales -> appendChild($portotal);

    $portotal = $doc->createElement('div');
    $portotal -> setAttribute('class', 'f7 animate stack1');
    $uno = $doc -> createElement('div', 'Valor total sin Impuestos');
    $uno -> setAttribute('class', 'one-five');
    $dos = $doc -> createElement('div', $wk_ValorSinImpuestos);
    $dos -> setAttribute('class', 'six-seven');
    
    $portotal -> appendChild($uno);
    $portotal -> appendChild($dos);
    
    $totales -> appendChild($portotal);
    
    $portotal = $doc->createElement('div');
    $portotal -> setAttribute('class', 'f7 animate stack1');
    $uno = $doc -> createElement('div', 'Valor total de Impuesto');
    $uno -> setAttribute('class', 'one-five');
    $dos = $doc -> createElement('div', $wk_TotalImpuestos);
    $dos -> setAttribute('class', 'six-seven');
    
    $portotal -> appendChild($uno);
    $portotal -> appendChild($dos);
    
    $totales -> appendChild($portotal);
    
    $portotal = $doc->createElement('div');
    $portotal -> setAttribute('class', 'f7 animate stack1');
    $uno = $doc -> createElement('div', 'Valor total Facturado');
    $uno -> setAttribute('class', 'one-five');
    $dos = $doc -> createElement('div', $wk_TotalTotal);
    $dos -> setAttribute('class', 'six-seven');
    
    $portotal -> appendChild($uno);
    $portotal -> appendChild($dos);
    
    $totales -> appendChild($portotal);
    $doc->saveHTMLFile($salida);
    $flagEmail = enviaFacturasSeleccionadas($param);
    
    /* close statement */
    $stmt->close();
    $db->close();
    
    return $flagEmail;;
 }

function updateFactura($fechaInicio, $fechaFin) {
//    var_dump($fechaInicio, $fechaFin);
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "UPDATE invoice SET CustomField11 = 'SELECCIONADA' where TxnDate >=? and TxnDate <= ? and CustomField11 is null";
//    $sql = "UPDATE invoice SET CustomField11 = 'SELECCIONADA' LIMIT 40";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
//   $seleccionada = NULL;
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    $flag = "No se proceso Actualizacion de facturas seleccionadas";
    $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    $flag = "*** ERROR No se han seleccionado facturas " . $nroRegistrosAfectados;
    if ($nroRegistrosAfectados > 0) {
        $flag = 'OK Se Actualizaron las facturas seleccionadas';
    }
        /* close statement */
    $stmt->close();
    
    return $flag;
}
function enviaFacturasSeleccionadas($param) {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    $directorio = 'file:///C:/wamp/www/Salgraf/archivos/' . $param;
    $part = '<html><head></head><body><div><b>Nombre: </b>' . $_SESSION['nombre'] . '<br><b>Apellido: </b>' . $_SESSION['apellido'] . '<br>';
    $part .= '<br><hr><br><span>Usted puede ir a esta direccion para ver el archivo </span>';
    $part .= '<br><hr><br><span>' .$directorio . '</sapn><br><br><span>Copie este link en una nueva ventana de su buscador favorito</span></div></body></html>';

    $body = 'Nombre: ' . $_SESSION['nombre'] . 'Apellido: ' . $_SESSION['apellido'] . "\r\n";
    $body .= 'Usted esta ahbilitado para utilizar el sistema de comprobantes electronicos\r\n';
    $body .= $directorio . ' Ver el archivo \r\n ';
    
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Facturas Seleccionadas';
    $paraemail['fromemail']['email'] = 'salgraf.sistema@gmail.com';
    $paraemail['fromemail']['nombre'] = 'Sistema';
    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'].' '.$_SESSION['apellido'];
    
    $flagEmail = enviamail($paraemail);
    if ($flagEmail == "Sent") {
    $flagEmail = 'OK Se Actualizaron las facturas seleccionadas, y se envio el email';
        
    } else {
        $flagEmail = 'OK Se Actualizaron las facturas seleccionadas no se pudo enviar email';
    
    } 
    
    return $flagEmail;
}
?>
</html>