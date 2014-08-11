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
 * Fecha:   Agosto 11, 2014
 * Proyecto: Comprobantes Electronicos
 */

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
if ($_SESSION['email'] != 'contador@calcograf.com') {
    require 'paraMensajes.html';
    echo '<script type="text/javascript">'.
        "$(document).ready(function(){".
        "$('#mensaje').text('*** ERROR No tiene acceso a esta opcion');".
        "})".
        "</script>";
        exit();
}

    include '../include/conectaBaseDatos.php';
    $flagDB = borraUsuarios();
    ?>
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
    session_destroy();
    exit();?>

<?php
function borraUsuarios() {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $sql = "delete from usuarios where UsuariosEmail != ' ' ";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $stmt->execute();
    $numeroAfectados = $db -> affected_rows;
    if ($numeroAfectados > 0){
        $flagBorra = 'Se han eliminado los usuarios';
    } else {
        $flagBorra = '*** ERROR No se ejecuto la limpieza de usuarios';
    }
    $stmt->close();
    $db->close();
    
    return $flagBorra;
    
}