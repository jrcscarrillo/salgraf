<?php

/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 6 2014
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
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('Usuario ya esta ingresado an el sistema');".
        "})".
        "</script>";
        exit();
}
}
/*
 * Llama a la funcion de conectarse a la base de datos
 * Revisa si se han ingresado datos en el programa login.html
 * Caso contrario emite un mensaje de error
 */
include 'conectaBaseDatos.php';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $flagDB = loginUsuario($email, $password);
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
function loginUsuario($email, $password) {
//    var_dump($GLOBALS);

        $passencriptada = hash('sha256', $password);
    
        $db = db_connect();
        $sql = "select * from Usuarios where UsuariosEmail=? and UsuariosPassword=?";
        $stmt = $db->prepare($sql) or die(mysqli_error($db));
        $stmt->bind_param("ss", $email, $passencriptada);
        $stmt->bind_result($wk_id, $wk_email, $wk_pass, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
        $existe = $stmt->execute();
//        var_dump($wk_id, $email, $password);
        if ($stmt->fetch()){
            $flag = TRUE;
            if ($wk_habilita == 1) {
                require 'paraContinuar.html';
                echo '<script type="text/javascript">'.
                        "$(document).ready(function(){".
                        "$('#mensaje').text('El usuario ha ingresado saisfactoriamente');".
                        "})".
                        "</script>";
                $_SESSION['carrillosteam'] = 'carrillosteam';
                $_SESSION['nombre'] = $wk_nombre;
                $_SESSION['apellido'] = $wk_apellido;
                $_SESSION['email'] = $wk_email;
                
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