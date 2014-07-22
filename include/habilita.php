<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 22 2014
 * Proyecto: Comprobantes Electronicos
 */

/*
 * Se definen las variables que seran utilizadas como glbal en este programa
 */
  
$wk_id = "";
$wk_email = "";
$wk_pass = "";
$wk_habilita = 0;
$wk_nombre = "";
$wk_apellido = "";
$wk_estado = "";;
  
session_start();
/*
 * Si tiene una sesion no iniciada envia el mensaje "Usuario no esta ingresado an el sistema"
 */
if ((!isset( $_SESSION['carrillosteam'] )) or ($_SESSION['carrillosteam'] != 'carrillosteam')) {
    $flagDB = "Usuario no tiene autorizacion";
    return $flagDB;
    exit();
}

/*
 * Llama a la funcion de conectarse a la base de datos
 * Revisa si se han ingresado datos en el programa habilita.html
 * Caso contrario emite un mensaje de error
 */
include 'conectaBaseDatos.php';
if (isset($_POST['emailForm'])) {
    $email = $_POST['emailForm'];
    $flagDB = buscaUsuario($email);
    } else {
    $flagDB = "No ha ingresado datos";
    }
echo $flagDB;
exit();
/*
 * Accesa a la base de datos con el la direccion email y la clave
 * Si el campo de la base de datos 'UsuariosHabilitado' tiene 1 significa que puede seguir realizando los
 * procesos en el sistema.
 * Caso contrario es rechazado
 */
function buscaUsuario($email) {
        global $wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado;
        $db = db_connect();
        $sql = "select * from Usuarios where UsuariosEmail=?";
        $stmt = $db->prepare($sql) or die(mysqli_error($db));
        $stmt->bind_param("s", $email);
        $stmt->bind_result($wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
        $existe = $stmt->execute();
//        var_dump($wk_id, $email, $password);
        if ($stmt->fetch()){
            $flagHabilita = "";
            if ($wk_habilita == 0) {
                $flagHabilita = habilitaUsuario($email);
                } else {
                    $flagHabilita = "Ya esta habilitado";
                    }
                    } else {
                        $flagHabilita = "Usuario no existe";
                        }
        $stmt->close();
        $db->close();
        return $flagHabilita;
}

function habilitaUsuario($email) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "UPDATE Usuarios SET UsuariosHabilitado = ? where UsuariosEmail=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $uno = 1;
    $stmt->bind_param("is", $uno, $email);
    $flagHabilita = "";
    $existe = $stmt->execute();
    $nroRegistrosAfectados = $stmt->affected_rows;
    if ($nroRegistrosAfectados > 0) {
        $flagHabilita = enviaHabilitado();
        if($flagHabilita == "Sent"){
            $flagHabilita = "Usuario Habilitado se envio Email";
        } else {
            $flagHabilita = "Usuario Habilitado no se envio Email";
        }
        } else {
            $flagHabilita = "Error usuario no se habilito";
        }
        /* close statement */
    $stmt->close();
    $db->close();
    return $flagHabilita;
}

function enviaHabilitado() {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    global $wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado;
//    var_dump($wk_email, $wk_apellido, $wk_nombre);
    $part = '<div><b>Nombre: </b>' . $wk_nombre . "<br>" . '<b>Apellido: </b>' . $wk_apellido. "<br>";
    $part .= '<br><hr><br><span>Usted esta ahbilitado para utilizar el sistema de comprobantes electronicos</span></div>'; 
    
    
    $body = 'Nombre: ' . $wk_nombre . 'Apellido: ' . $wk_apellido . "\r\n";
    $body .= 'Usted esta ahbilitado para utilizar el sistema de comprobantes electronicos\r\n'; 
    
    $paraemail['attach'] = $_SERVER['DOCUMENT_ROOT'] . '/favicon.ico';
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Nuevo Usuario';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
    $paraemail['toemail']['email'] = $wk_email;
    $paraemail['toemail']['nombre'] = $wk_nombre.$wk_apellido;
//    var_dump($paraemail);
    $flagEmail = enviamail($paraemail);
    return $flagEmail;
}