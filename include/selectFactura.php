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
        "$('#mensaje').text('*** ERROR Tiene seleccionadas fechas de proceso');".
        "})".
        "</script>";
        exit();    
}
    include 'conectaBaseDatos.php';
    $wk_start = $_POST['start'];
    $wk_finish = $_POST['finish'];
    $wk_archivo = $_POST['archivo'];
    $inicioDB = strtotime($wk_start);
    $finDB = strtotime($wk_finish);
//    echo "Fecha con strtotime : " . $inicioDB;
    $fechaInicio = date('Y-m-d H:i:s', $inicioDB);
    $fechaFin = date('Y-m-d H:i:s', $finDB);
//    echo "Fecha con date : " . $inicio;
    $flagDB = updateFactura($fechaInicio, $fechaFin, $wk_archivo);
    if ($flagDB == 'OK Se Actualizaron las facturas seleccionadas') {
        $flagDB = chkFactura($fechaInicio, $fechaFin, $wk_archivo);
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
function chkFactura($wk_start, $wk_finish, $wk_archivo) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    $sql = "select CustomerRefFullName, TxnDate, RefNumber,SalesTaxPercentage, SalesTaxTotal, AppliedAmount, BalanceRemaining, CustomField10 from invoice where TxnDate >= ? and TxnDate <= ?";
    $sql = "select TxnID, CustomerRef_FullName, TxnDate, RefNumber, SalesTaxPercentage, SalesTaxTotal, AppliedAmount, BalanceRemaining, CustomField10 from invoice where CustomField10 =?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $wk_seleccionada = "SELECCIONADA";
    $stmt->bind_param("s", $wk_seleccionada);
    $stmt->execute();
    $stmt->bind_result($wk_TxnID, $wk_CustomerRefFullName, $wk_TxnDate, $wk_RefNumber, $wk_SalesTaxPercentage, $wk_SalesTaxTotal, $wk_AppliedAmount, $wk_BalanceRemaining, $wk_CustomField10 );        /* fetch values */
    $wk_NumeroFacturas = 0;
    $wk_ValorSinImpuestos = 0;
    $wk_TotalImpuestos = 0;
    $wk_TotalTotal = 0;
    $wk_hoy = date("F j, Y, g:i a"); 
    
    $body = 'Texto alternativo para totales de control';
    $part = '<div><b>Fecha: </b>' . $wk_hoy . "<br>" . "<b>Facturas Seleccionadas: </b><br>";
    $part .= '<br><hr><br><span>Usted ha procesado las siguientes facturas, se enviara un email tanto a su correo como a contado</span></div>';
    $part .= '<br><hr><br><table>';
    
    
    while ($stmt->fetch()) {
        $part .= '<br><tr><td>' . $wk_CustomerRefFullName . '</td><td>' . $wk_TxnDate;
        $part .= '</td><td>' . $wk_RefNumber . '</td><td>' . $wk_SalesTaxPercentage;
        $part .= '</td><td>' . $wk_SalesTaxTotal . '</td><td>' . $wk_AppliedAmount;
        $part .= '</td><td>' . $wk_BalanceRemaining . '</td></tr>';
        $wk_TotalImpuestos = $wk_TotalImpuestos + $wk_SalesTaxTotal;
        $wk_ValorSinImpuestos = $wk_ValorSinImpuestos + ($wk_AppliedAmount - $wk_SalesTaxTotal);
        $wk_TotalTotal = $wk_TotalTotal + $wk_AppliedAmount;
        $wk_NumeroFacturas ++;
        
  }
    /* close statement */
    $stmt->close();
    $db->close();
    
    $part .= '</table><br><tr><td>Facturas Procesadas</td><td>' . $wk_NumeroFacturas . '</td><td>Totales</td><td></td><td>' . $wk_ValorSinImpuestos . '</td><td>' . $wk_TotalImpuestos . '</td><td>' . $wk_TotalTotal . '</td></tr>';
    $flagEmail = sendMail($part, $body);
    return $flagEmail;
 }

function updateFactura($fechaInicio, $fechaFin, $archivo) {
    
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    $sql = "UPDATE invoice SET CustomField10 = 'SELECCIONADA' where TxnDate >=? and TxnDate <= ? and CustomField10 = ?";
    $sql = "UPDATE invoice SET CustomField10 = 'SELECCIONADA' LIMIT 40";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
//   $seleccionada = "";
//    $stmt->bind_param("sss", $fechaInicio, $fechaFin, $sleccionada);
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
function sendMail($part, $body) {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Facturas Seleccionadas';
    $paraemail['fromemail']['email'] = 'salgraf@gmail.com';
    $paraemail['fromemail']['nombre'] = 'Comprobantes Electronicos';
    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'].$_SESSION['apellido'];
//    var_dump($paraemail);
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