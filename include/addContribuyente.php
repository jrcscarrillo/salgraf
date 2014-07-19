<?php
//include 'sriGeneraClaves.php';
include 'generaClave.php';
if (isset($_POST['rucForm'])) {
    $userName = "srijrcscarrillo";
    $password = "F9234568!s";
    $dbName = "srijrcscarrillo";
    $server = "srijrcscarrillo.db.10949679.hostedresource.com";
    $ruc = $_POST['rucForm'];
    $razon = $_POST['razonForm'];
    $comercial = $_POST['comercialForm'];
    $matriz = $_POST['matrizForm'];
    $telefono = $_POST['telefonoForm'];
    $email = $_POST['emailForm'];
    $emisor = $_POST['emisorForm'];
    $estab = $_POST['estabForm'];
    $punto = $_POST['puntoForm'];
    $resol = $_POST['resolForm'];
    $lleva = $_POST['llevaForm'];
    $ambiente = $_POST['ambienteForm'];
    $emision = $_POST['emisionForm'];
    $token = $_POST['tokenForm'];
    $nota = $_POST['notaForm'] . "\n";
    $archivo = $_FILES['file']['name'];
    $id = 0;
    $logo = " ";
    $wk_ruc = 0;
    $wk_razon = "";
    $wk_comercial = "";
    $wk_matriz = "";
    $wk_telefono = 0;
    $wk_email = "";
    $wk_emisor = "";
    $wk_estab = 0;
    $wk_punto = 0;
    $wk_resol = 0;
    $wk_lleva = "";
    $wk_ambiente = 0;
    $wk_emision = 0;
    $wk_token = 0;
    $wk_nota = "";
    $wk_id = 0;
    $wk_logo = " ";
    $flagDB = chkContribuyente();
    $flagMail = chkMail();
  //  $flagClave = desdeHastaClave($estab, 1, 1000);
    $flagClave = asignaClave($estab, $punto);
    echo "sale del envio del mail";
}

function chkContribuyente() {
    global $userName, $password, $dbName, $server;
    global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $nota, $telefono, $token;
    global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision;
    global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision;
    // header('Content-type: application/json' );
    $db = new mysqli($server, $userName, $password, $dbName);
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "select * from Contribuyente where ContribuyenteCodEmisor=? and ContribuyentePunto=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ii", $estab, $punto);
    $stmt->bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
    $existe = $stmt->execute();
    if ($stmt->num_rows() == 0) {
        $stmt->close();
        echo "No existe contribuyente\r\n";
        $flagNew = nuevoContribuyente($db);
    } else {
        $stmt->close();
        echo "error contribuyente ya existe\r\n";
    }

    /* close statement */
    $db->close();
    return true;
}

function nuevoContribuyente($db) {
    global $userName, $password, $dbName, $server;
    global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $nota, $telefono, $token;
    global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision;
    global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision;
    $sql = "insert into Contribuyente(ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial, ContribuyenteDirMatriz, ";
    $sql .= "ContribuyenteDirEmisor, ContribuyenteCodEmisor, ContribuyentePunto, ContribuyenteResolucion, ";
    $sql .= "ContribuyenteLlevaContabilidad, ContribuyenteLogo, ContribuyenteAmbiente, ContribuyenteEmision";
    $sql .= ") values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    // pone una variable como base para encriptar cualquier dato $salt = "free!@#$%thg%$#@!kliofree!@#$%thg%$#@!klio";
    // calcula la clve encriptada $userhash = crypt($userpass, $salt);
    echo "Id: " . $id . " RUC: " . $ruc . "\n" . "Razon Social: " . $razon . " Nombre Comercial: " . $comercial .
    "\n" . "Direccion Matriz: " . $matriz . " Direccion Emisor: " . $emisor .
    "\n" . "Establecimiento: " . $estab . " Punto Emision: " . $punto .
    "\n" . "Resolucion: " . $resol . " Lleva Contabilidad: " . $lleva .
    "\n" . "Logo" . $logo . " Ambiente: " . $ambiente . " Tipo Emision: " . $emision;
    if (isset($_FILES['file']['tmp_name'])) {
        // Read the file into a variable
        $file = fopen($_FILES['file']['tmp_name'], 'r');
        $size = $_FILES['file']['size'];
        $logo = fread($file, $size);
        fclose($file);
    } else {
        echo "No pudo leer logo\r\n";
        $content = NULL;
    }
    $stmt->bind_param("issssiisssii", $ruc, $razon, $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    $sql = "select * from Contribuyente where idContribuyente=?";
    if ($selectTaskStmt = $db->prepare($sql)) {
        $selectTaskStmt->bind_param("i", $newId);
        $selectTaskStmt->bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
        $selectTaskStmt->execute();
        if ($selectTaskStmt->fetch()) {
            echo "Contribuyente adicionado\r\n";
        } else {
            echo "error contribuyente no se adiciono\r\n";
        }
    }
}

function chkMail() {
    global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $telefono, $token, $nota, $archivo;
    global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision;
    global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision;
    require 'PHPMailerAutoload.php';
    require 'PHPMailer.php';
    var_dump($_FILES);
//Create a new PHPMailer instance
    $mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
//Set who the message is to be sent from
    $mail->setFrom('jrcscarrillo@gmail.com', 'Juan Carrillo');
//Set an alternative reply-to address
    $mail->addReplyTo('support@carrillosteam.com', 'Juan Carrillo');
//Set who the message is to be sent to
    $mail->addAddress($email, $comercial);
//Set the subject line
    $mail->Subject = 'Utilizando PHPMailer ?';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $body = '<div><b>RUC: </b>' . $ruc . "<br>" . '<b>Razon: </b>' . $razon . "<br>";
    $body .= '<b>Nombre Comercial: </b>' . $comercial . "<br>" . '<b>Direccion Oficina Principal: </b>' . $matriz . "<br>";
    $body .= '<b>Direccion Emisor: </b>' . $emisor . "<br>" . '<b>Codigo Establecimiento: </b>' . $estab . "<br>";
    $body .= '<b>Codigo Punto de Emision: </b>' . $punto . "<br>";
    $body .= '<b>Numero Resolucion: </b>' . $resol . "<br>";
    $body .= '<b>Lleva Contabilidad?: </b>' . $lleva . "<br>";
    $body .= '<b>Ambiente de Proceso: </b>' . $ambiente . "<br>";
    $body .= '<b>Forma de Emisiom: </b>' . $emision . "<br>";
    $body .= '<br><hr><br><span>Este contribuyente se ha adicionado correctamente</span></div>'; 
	if (isset($_FILES['file']['tmp_name'])) {
		// Read the file into a variable
		$file = $_FILES['file']['tmp_name'];
		$name = $_FILES['file']['name'];
        }
    $mail->msgHTML($body);
    $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
    $mail->addAttachment($file, $name);

//send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}

?>