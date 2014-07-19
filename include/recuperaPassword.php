<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 17 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
/*
 * Si tiene una sesion iniciada envia el mensaje "Usuario ya esta ingresado an el sistema"
 */
if (isset( $_SESSION['carrillosteam'] )) {
    if ($_SESSION['carrillosteam'] == 'carrillosteam') {
//    var_dump($_SESSION);
    require 'paraMensajes.html';
    echo 'YA';
    exit();
}
}
/*
 * Llama a la funcion de conectarse a la base de datos
 * Revisa si se han ingresado datos en el programa login.html
 * Caso contrario emite un mensaje de error
 */
include 'conectaBaseDatos.php';
echo 'Pasa por POST';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $flagDB = loginUsuario($email);
    exit();
} else {
    require 'paraContinuar.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('No ha ingresado datos');".
        "})".
        "</script>"; 
        exit();
}
/*
 * Accesa a la base de datos con el la direccion email 
 * Si el campo de la base de datos 'UsuariosHabilitado' tiene 1 significa que se puede enviar el
 * mensaje por medio de la direccion de email registrado
 * Caso contrario es rechazado
 */
function loginUsuario($email) {
    $db = db_connect();
        $sql = "select * from Usuarios where UsuariosEmail=? ";
        $stmt = $db->prepare($sql) or die(mysqli_error($db));
        $stmt->bind_param("s", $email);
        $stmt->bind_result($wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
        $existe = $stmt->execute();
//        var_dump($wk_id, $email, $password);
        if ($stmt->fetch()){
            $flag = TRUE;
            if ($wk_habilita == 1) {
                chkMail($email, $wk_nombre, $wk_apellido);
                } else {
                require 'paraContinuar.html';
                echo '<script type="text/javascript">'.
                        "$(document).ready(function(){".
                        "$('#mensaje').text('Usuario registrado pero no esta habilitado. Contactarse con el administrador');".
                        "})".
                        "</script>";
                }
        } else {
            require 'paraMensajes.html';
            echo '<script type="text/javascript">'.
                    "$(document).ready(function(){".
                    "$('#mensaje').text('Usuario no existe');".
                    "})".
                    "</script>";
        }
        $stmt->close();
        $db->close();

}
function chkMail($email, $wk_nombre, $wk_apellido) {
    require 'PHPMailerAutoload.php';
    require 'PHPMailer.php';
    $wk_string = openssl_random_pseudo_bytes(8);
    $wk_clave = hash('sha256', $wk_string);
    updateUsuario($email, $wk_clave);
    $mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
//Set who the message is to be sent from
    $mail->setFrom('jrcscarrillo@gmail.com', 'Juan Carrillo');
//Set an alternative reply-to address
    $mail->addReplyTo('support@carrillosteam.com', 'Juan Carrillo');
//Set who the message is to be sent to
    $mail->addAddress($email, $wk_nombre, $wk_apellido);
//Set the subject line
    $mail->Subject = 'Le enviamos su clave';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $body = '<div><b>Email: </b>' . $email . "<br>" . '<b>Apellido: </b>' . $wk_apellido. "<br>";
    $body .= '<b>Nombre: </b>' . $wk_nombre . "<br> . <b>Clave: </b>" . $wk_string . "<br>";
    $body .= '<br><hr><br><span>Esta es su nueva clave</span></div>'; 

    $mail->msgHTML($body);
    $mail->AltBody = 'This is a plain-text message body';
    
//send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}

function updateUsuario($email, $wk_clave) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "UPDATE Usuarios SET UsuariosPassword = ? where UsuariosEmail=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("ss", $wk_clave, $email);
    $flag = FALSE;
    $existe = $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    if ($nroRegistrosAfectados > 0) {
        $flag = TRUE;
    }
        /* close statement */
    $stmt->close();
    $db->close();
    return $flag;
}