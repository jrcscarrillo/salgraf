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
            .row {
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
    <body class="bg-cyan">
        <div class="body body-m">		
            <form action="../index.html" id="sky-form" class="sky-form">
                <header>Continuar</header>
                <fieldset>
                    <section>       
<?php
    include 'conectaBaseDatos.php';
    $arrayError = busca_error_sri('49');
    ?>
    <div class="row">DESCRIPCION: <?php echo $arrayError['Descripcion']?></div>
    <div class="row">CAUSA: <?php echo $arrayError['Causa']?></div>
<?php    
    $arrayError = busca_error_sri('02');
    ?>
                   <div class="row">DESCRIPCION: <?php echo $arrayError['Descripcion']?></div>
                   <div class="row">CAUSA: <?php echo $arrayError['Causa']?></div>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="button">Continuar</button>
                </footer>
            </form>			
        </div>
    </body>
<?php    

function busca_error_sri($param) {
    
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $flagPasa = 'Buscar error';
    $sql = "SELECT * FROM errores WHERE erroresTipo = ? AND erroresCodigo = ?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
    $wk_tipo = "SRI";
    $wk_codigo = $param;
        
    $stmt->bind_param("ss", $wk_tipo, $wk_codigo);
    $stmt->execute();
    $stmt->bind_result($db_ID, $db_tipo, $db_codigo, $db_desc, $db_causa);        /* fetch values */
    $stmt->execute();
    while ($stmt->fetch()) {
        $flagPasa = $db_desc;
        $flagCausa = $db_causa;
    }
    $pasaArray = array("Descripcion" => $db_desc, "Causa" => $db_causa);
    return $pasaArray;
}
?>
</html>