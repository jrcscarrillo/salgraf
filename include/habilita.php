<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 18 2014
 * Proyecto: Comprobantes Electronicos
 */
session_start();
/*
 * Si tiene una sesion no iniciada envia el mensaje "Usuario no esta ingresado an el sistema"
 */
if ((!isset( $_SESSION['carrillosteam'] )) or ($_SESSION['carrillosteam'] != 'carrillosteam')) {
        require 'paraMensajes.html';
        echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('Usuario no esta ingresado an el sistema');".
        "})".
        "</script>";
        exit();
}

/*
 * Llama a la funcion de conectarse a la base de datos
 * Revisa si se han ingresado datos en el programa habilita.html
 * Caso contrario emite un mensaje de error
 */
include 'conectaBaseDatos.php';
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
 * Accesa a la base de datos con el la direccion email y la clave
 * Si el campo de la base de datos 'UsuariosHabilitado' tiene 1 significa que puede seguir realizando los
 * procesos en el sistema.
 * Caso contrario es rechazado
 */
function loginUsuario($email) {
        $db = db_connect();
        $sql = "select * from Usuarios where UsuariosEmail=?";
        $stmt = $db->prepare($sql) or die(mysqli_error($db));
        $stmt->bind_param("s", $email);
        $stmt->bind_result($wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
        $existe = $stmt->execute();
//        var_dump($wk_id, $email, $password);
        if ($stmt->fetch()){
            $flag = TRUE;
            if ($wk_habilita == 0) {
                $flag = habilitaUsuario($email);
                if ($flag) {
                    echo 'OK';
                }
            } else {
                require 'paraContinuar.html';
                echo '<script type="text/javascript">'.
                        "$(document).ready(function(){".
                        "$('#mensaje').text('Usuario registrado pero ya esta habilitado.');".
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

function habiltaUsuario($email) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "UPDATE Usuarios SET UsuariosHabilitado = ? where UsuariosEmail=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("ss", 1, $email);
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