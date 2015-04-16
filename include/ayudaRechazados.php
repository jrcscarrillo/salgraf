<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Junio 25 2014
 * Proyecto: Pruebas de clases
 */
include 'conectaBaseDatos.php';
include 'classUsuario.php';
if (isset($_POST['emailForm'])) {
    $email = $_POST['emailForm'];
    $password = $_POST['passForm'];
    $nombre = $_POST['nombreForm'];
    $apellido = $_POST['apellidoForm'];

    $id = 0;
    $wk_id = 0;
    $wk_email = 0;
    $wk_nombre = "";
    $wk_apellido = "";
    $wk_password = "";
    $encriptada = hash(sha256, $password);
    $wk_encriptada = "";
    $wk_habilita = 0;
    $habilita = 0;
    $wk_estado = 0;
    $estado = 0;

    $flagDB = chkUsuario();
    echo "sale del envio del mail";
}

function chkUsuario() {
    global $id, $wk_id, $wk_email, $wk_nombre, $wk_apellido, $wk_encriptada, $wk_habilita, $wk_estado, $wk_password, $email, $password, $nombre, $apellido;
    global $encriptada, $habilita, $estado;
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "select * from Usuarios where UsuariosEmail=? and UsuariosPassword=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("ss", $email, $encriptada);
    $stmt->bind_result($wk_id, $wk_email, $wk_encriptada, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
    $existe = $stmt->execute();
    if ($stmt->num_rows() == 0) {
        $stmt->close();
        echo "No existe usuario\r\n";
        $flagNew = nuevoUsuario();
    } else {
        $stmt->close();
        echo "error contribuyente ya existe\r\n";
    }

    /* close statement */
    $db->close();
    return true;
}

function nuevoUsuario() {
    global $id, $wk_id, $wk_email, $wk_nombre, $wk_apellido, $wk_encriptada, $wk_habilita, $wk_estado, $wk_password, $email, $password, $nombre, $apellido;
    global $encriptada, $habilita, $estado;
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "insert into Usuarios(UsuariosEmail, UsuariosPassword, UsuariosHabilitado, UsuariosNombre, UsuariosApellido, UsuariosEstado";
    $sql .= ") values(?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    echo "Id: " . $id . " Email: " . $email . "\n" . "Nombres: " . $nombre . " Apellidos: " . $apellido;
    
    $stmt->bind_param("ssissi", $email, $encriptada, $habilita, $nombre, $apellido, $estado);
    $stmt->execute();
    // Get the ID generated from the previous INSERT operation
    $newId = $db->insert_id;
    $sql = "select * from Usuarios where idUsuarios=?";
    if ($selectTaskStmt = $db->prepare($sql)) {
        $selectTaskStmt->bind_param("i", $newId);
        $selectTaskStmt->bind_result($wk_id, $wk_email, $wk_encriptada, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
        $selectTaskStmt->execute();
        if ($selectTaskStmt->fetch()) {
            echo "Usuario adicionado\r\n";
            $flag = chkMail();
        } else {
            echo "error usuario no se adiciono\r\n";
        }
    }
}

function chkMail() {
    global $id, $wk_id, $wk_email, $wk_nombre, $wk_apellido, $wk_encriptada, $wk_habilita, $wk_estado, $wk_password, $email, $password, $nombre, $apellido;
    global $encriptada, $habilita, $estado;
    require 'PHPMailerAutoload.php';
    require 'PHPMailer.php';
//Create a new PHPMailer instance
    $mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
//Set who the message is to be sent from
    $mail->setFrom('info@carrillosteam.com', 'Juan Carrillo');
//Set an alternative reply-to address
    $mail->addReplyTo('support@carrillosteam.com', 'Juan Carrillo');
//Set who the message is to be sent to
    $mail->addAddress($email, $nombre, $apellido);
//Set the subject line
    $mail->Subject = 'Utilizando Comprobantes Electronicos ?';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $body = '<div><b>Nombre: </b>' . $nombre . "<br>" . '<b>Apellido: </b>' . $apellido. "<br>";
    $body .= '<br><hr><br><span>Usted se ha registrado en el sistema de comprobantes electronicos, se enviara un email indicandole que esta habilitado</span></div>'; 
    $mail->msgHTML($body);
    $mail->AltBody = 'This is a plain-text message body';

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}

?>