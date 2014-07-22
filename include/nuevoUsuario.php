<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Junio 22 2014
 * Proyecto: Comprobantes Electronicos
 */
include 'conectaBaseDatos.php';
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
    $encriptada = hash('sha256', $password);
    $wk_encriptada = "";
    $wk_habilita = 0;
    $habilita = 0;
    $wk_estado = 0;
    $estado = 0;
    $saleEmail = '';
    $estadoUsuario = '';

    $flagDB = chkUsuario();
    $saleEmail = "sale del envio del mail";
    echo $flagDB;
}

function chkUsuario() {
    global $id, $wk_id, $wk_email, $wk_nombre, $wk_apellido, $wk_encriptada, $wk_habilita, $wk_estado, $wk_password, $email, $password, $nombre, $apellido;
    global $encriptada, $habilita, $estado;
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "select * from Usuarios where UsuariosEmail=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->bind_param("s", $email);
    $stmt->bind_result($wk_id, $wk_email, $wk_encriptada, $wk_habilita, $wk_nombre, $wk_apellido, $wk_estado);
    $existe = $stmt->execute();
    if (!$stmt->fetch()) {
        $stmt ->close();
        $estadoUsuario = "No existe usuario";
        $flagNew = nuevoUsuario();
    } else {
        $stmt->close();
        if ($wk_email == $email) {
            $flagNew  = "Nombre de Usuario Ya Existe";
        } elseif ($wk_encriptada == $encriptada) {
            $flagNew = "Password Invalida";
        }
    }
    return $flagNew;
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
//    echo "Id: " . $id . " Email: " . $email . "\n" . "Nombres: " . $nombre . " Apellidos: " . $apellido;
    
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
            $estadoUsuario = "Usuario adicionado";
            $flagEmail = chkMail();
        } else {
            $estadoUsuario = "Error usuario no se adiciono";
        }
    }
    return $estadoUsuario;
}

function chkMail() {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    global $email, $password, $nombre, $apellido;
    global $encriptada, $habilita, $estado;
    
    
    $part = '<div><b>Nombre: </b>' . $nombre . "<br>" . '<b>Apellido: </b>' . $apellido. "<br>";
    $part .= '<br><hr><br><span>Usted se ha registrado en el sistema de comprobantes electronicos, se enviara un email indicandole que esta habilitado</span></div>'; 
    
    
    $body = 'Nombre: ' . $nombre . 'Apellido: ' . $apellido . "\r\n";
    $body .= 'Usted se ha registrado en el sistema de comprobantes electronicos, se enviara un email indicandole que esta habilitado\r\n'; 
    
    $paraemail['attach'] = $_SERVER['DOCUMENT_ROOT'] . '/favicon.ico';
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Nuevo Usuario';
    $paraemail['fromemail']['email'] = 'contador@calcograf.com';
    $paraemail['fromemail']['nombre'] = 'Contabiliad';
    $paraemail['toemail']['email'] = $email;
    $paraemail['toemail']['nombre'] = $nombre.$apellido;
//    var_dump($paraemail);
    $flagEmail = enviamail($paraemail);

}
