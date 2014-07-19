<?php
/* 
 * Autor:   Juan Carrillo
 * Fecha:   Julio 1, 2014
 * Proyecto: Comprobantes Electronicos
 */
//var_dump($GLOBALS);
    session_start();
    include 'conectaBaseDatos.php';
if (isset($_POST['Facturas'])) {
//    $facturas = $_POST['Facturas'];
    $facturas = str_replace("},", "}|", $_POST['Facturas']);
    $factura = explode("|", $facturas);
    for($i=0; $i < count($factura); $i++) {
    $registro = json_decode($factura[$i]);
//    var_dump($factura[$i]);
    if(strlen($factura[$i]) != 0){
        foreach ($registro as $key => $value) {
//            echo "Estos Datos {$key} is {$value}\n";
            if($key === "Numero"){
                $wk_factura = $value;
            } elseif ($key === "Cliente") {
                $wk_cliente = $value;
            } elseif ($key === "Valor") {
                $wk_valor = $value;
                chkFactura($wk_factura, $wk_cliente, $wk_valor);
            }
        }
    }
    }
} 

function chkFactura($wk_factura, $wk_cliente, $wk_valor) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
//    echo "Numero: " . $wk_factura . " \n";
    $stmt = "";
    $sql = "select TxnID, TxnNumber, CustomerRef_FullName, CustomField10 from invoice where TxnNumber=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("s", $wk_factura);
    $flag = FALSE;
    $existe = $stmt->execute();
    $stmt->bind_result($db_id, $db_numero, $db_cliente, $db_estado);        /* fetch values */
            while ($stmt->fetch()) {
                $flag = TRUE;
        //        echo 'Si encontro al ' . $db_cliente . ' que tiene la factura ' . $db_numero;
            }
    /* close statement */
    $stmt->close();
    $db->close();
            if($flag){
                $control = updateFactura($wk_factura, $wk_cliente, $wk_valor);
            } 
    if($control){
        echo '{ "Siga": "GO" }';
    }
 }

function updateFactura($wk_factura, $wk_cliente, $wk_valor) {
    $db = db_connect();
    if ($db->connect_errno) {
        die('Error de Conexion: ' . $db->connect_errno);
    }
    $stmt = "";
    $sql = "UPDATE invoice SET CustomField10 = 'SELECCIONADA' where TxnNumber=?";
    $stmt = $db->prepare($sql) or die(mysqli_error($db));
   
    $stmt->bind_param("s", $wk_factura);
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
