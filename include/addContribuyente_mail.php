<?php
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
	$id = 0;
	$logo = " ";
	$wk_ruc = 0;
	$wk_razon =  "";
	$wk_comercial =  "";
	$wk_matriz =  "";
	$wk_telefono = 0;
	$wk_email =  "";
	$wk_emisor =  "";
	$wk_estab = 0;
	$wk_punto = 0;
	$wk_resol = 0;
	$wk_lleva =  "";
	$wk_ambiente = 0;
	$wk_emision = 0;
	$wk_token = 0;
	$wk_nota =  "";
	$wk_id = 0;
	$wk_logo = " ";
	$flagDB = chkContribuyente();
	$flagMail = chkMail();
	echo "sale del envio del mail";

}
function chkContribuyente() {
	global $userName, $password, $dbName, $server;
	global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $nota, $telefono, $token;
	global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision;
	global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision;
	// header('Content-type: application/json' );
	$db = new mysqli($server, $userName, $password, $dbName);
	if ($db -> connect_errno) {
		die('Error de Conexion: ' . $db -> connect_errno);
	}
        $stmt = "";
	$sql = "select * from Contribuyente where ContribuyenteCodEmisor=? and ContribuyentePunto=?";
	$stmt = $db -> prepare($sql) or die(mysqli_error($db));
		$stmt -> bind_param("ii", $estab, $punto);
		$stmt -> bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
		$existe = $stmt -> execute();
		if ($stmt -> num_rows() == 0) {
                        $stmt -> close();
			echo "No existe contribuyente\r\n";
			$flagNew = nuevoContribuyente($db);
		} else {
                        $stmt -> close();
			echo "error contribuyente ya existe\r\n";
		}

		/* close statement */
	$db -> close();
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
	$stmt = $db -> prepare($sql) or die(mysqli_error($db));
	// pone una variable como base para encriptar cualquier dato $salt = "free!@#$%thg%$#@!kliofree!@#$%thg%$#@!klio";
	// calcula la clve encriptada $userhash = crypt($userpass, $salt);
	echo "Id: " . $id . " RUC: " . $ruc . "\n" . "Razon Social: " . $razon . " Nombre Comercial: " . $comercial . 
	"\n" . "Direccion Matriz: " . $matriz . " Direccion Emisor: " . $emisor .
	"\n" .  "Establecimiento: " . $estab . " Punto Emision: " . $punto .
	"\n" .  "Resolucion: " . $resol . " Lleva Contabilidad: " . $lleva .
	"\n" .  "Logo" . $logo . " Ambiente: " . $ambiente . " Tipo Emision: " . $emision;
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
	$stmt -> bind_param("issssiisssii", $ruc, $razon, $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision);
	$stmt -> execute();
	// Get the ID generated from the previous INSERT operation
	$newId = $db -> insert_id;
	$sql = "select * from Contribuyente where idContribuyente=?";
	if ($selectTaskStmt = $db -> prepare($sql)) {
		$selectTaskStmt -> bind_param("i", $newId);
		$selectTaskStmt -> bind_result($wk_id, $wk_ruc, $wk_razon, $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision);
		$selectTaskStmt -> execute();
		if ($selectTaskStmt -> fetch()) {
			echo "Contribuyente adicionado\r\n";
		} else {
			echo "error contribuyente no se adiciono\r\n";
		}
	}
}

function chkMail() {
	global $id, $wk_id, $ruc, $wk_ruc, $razon, $wk_razon, $email, $telefono, $token, $nota;
	global $comercial, $matriz, $emisor, $estab, $punto, $resol, $lleva, $logo, $ambiente, $emision;
	global $wk_comercial, $wk_matriz, $wk_emisor, $wk_estab, $wk_punto, $wk_resol, $wk_lleva, $wk_logo, $wk_ambiente, $wk_emision;
        $to = 'jrcscarrillo@gmail.com';
	$subject = 'Pruebas de las Formas';
	$message = 'RUC: ' . $ruc . "\r\n" . 'Razon: ' . $razon . "\r\n" . 'Nombre Comercial: ' . $comercial . "\r\n" . 'Direccion Oficina Principal: ' . $matriz . "\r\n" . 'Direccion Emisor: ' . $emisor . "\r\n" . 'Codigo Establecimiento: ' . $estab . "\r\n" . 'Codigo Punto de Emision: ' . $punto . "\r\n" . 'Numero Resolucion: ' . $resol . "\r\n" . 'Lleva Contabilidad?: ' . $lleva . "\r\n" . 'Ambiente de Proceso: ' . $ambiente . "\r\n" . 'Forma de Emisiom: ' . $emision . "\r\n";
	// Get a random 32 bit number.
	$num = md5(time());
	// Define the main headers.
	$headers = 'From:' . $email . "\r\n";
	$headers .= 'Reply-To: jrcscarrillo@gmail.com' . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-Type: multipart/mixed; ";
	$headers .= "boundary=$num" . "\r\n";
	$headers .= "--$num" . "\r\n";
	//$headers .= "X-Mailer: PHP/" . phpversion();
	// Define the message section
	$headers .= "Content-Type: text/plain" . "\r\n";
	$headers .= "Content-Transfer-Encoding:8bit" . "\r\n" . "\r\n";
	$headers .= $message . "\r\n";
	$headers .= "--$num" . "\r\n";
	// var_dump($_FILES);
	if (!isset($_FILES['file']['tmp_name'])) {
		// Read the file into a variable
		$file = fopen($_FILES['file']['tmp_name'], 'r');
		$size = $_FILES['file']['size'];
		$content = fread($file, $size);
		$encoded_content = chunk_split(base64_encode($content));
		// Define the attachment section
		$headers .= "Content-Type: " . $_FILES['file']['type'] . " ";
		$headers .= "name=" . $_FILES['file']['name'] . "\r\n";
		$headers .= "Content-Transfer-Encoding: base64" . "\r\n";
		$headers .= "Content-Disposition: attachment; ";
		$headers .= "filename=" . $_FILES['file']['name'] . "\r\n" . "\r\n";
		$headers .= $encoded_content . "\r\n";
		$headers .= "--$num--";
	}
	var_dump($to, $subject, $headers);
	if(mail($to, $subject, '', $headers)) {
            echo "Mail OK\r\n";
        } else {
            echo "NOOOOOOOOOOOO mail\r\n";
        }
}
?>