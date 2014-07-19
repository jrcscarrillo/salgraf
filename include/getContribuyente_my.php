<?php
    $userName = "srijrcscarrillo";
    $password = "F9234568!s";
    $dbName = "srijrcscarrillo";
    $server = "srijrcscarrillo.db.10949679.hostedresource.com";
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
	$amt=10; 
  	$start=0; 
	$aaData = array();
	
	$db = new mysqli($server, $userName, $password, $dbName);
	if ($db -> connect_errno) {
		die('Error de Conexion: ' . $db -> connect_errno);
	}
	$sql = "select * from Contribuyente";
	if ($stmt = $db -> query($sql)) {
		$nroContribuyentes = $stmt->num_rows;
	} else {
		echo "No accesa a la base de datos";
	}
	$sql = "select ContribuyenteRuc, ContribuyenteRazon, ContribuyenteNombreComercial from Contribuyente order by ContribuyenteRazon limit $start,$amt";
	if ($stmt = $db -> query($sql)) {
		while ($registro = $stmt -> fetch_assoc()) {
			$record = array('"Ruc":' => $registro["ContribuyenteRuc"], '"Razon":' => $registro["ContribuyenteRazon"], '"Comercial":' => $registro["ContribuyenteNombreComercial"]);
			$aaData[]=$record;
		}
		$varJson = array('"draw":' => 1, '"recordsTotal":' => $nroContribuyentes, '"recordsFiltered":' => $amt, '"data":' => $aaData );
		//var_dump($varJson);
                //$record = array( '"data":' => $aaData );
		echo json_encode($varJson);
                //echo $varJson; error invalid JSON response
    	/* free result set */
    	$stmt->free();
		/* close statement */
		//$stmt -> close();
	} else {
		echo "No accesa a la base de datos";
	}
	$db -> close();
	//return true;
?>