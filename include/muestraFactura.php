<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$param = 'juan20140701.html';
$directorio = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . 'facturaSeleccionadas.html';
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
copy($directorio, $salida);
$doc = new DOMDocument();
$doc->loadHTMLFile($salida);
$factura = $doc->getElementById('factura');

$wk_cliente = 'Juan Carrillo';

$x = 0;
while ($x < 3) {
    echo $x; 
    
$lossiete = $doc->createElement('div');
$lossiete -> setAttribute('class', 'f7 animate stack1');

$uno = $doc -> createElement('div', $wk_cliente);
$uno -> setAttribute('class', 'one');
$dos = $doc -> createElement('div', $wk_cliente);
$dos -> setAttribute('class', 'two');
$tres = $doc -> createElement('div', $wk_cliente);
$tres -> setAttribute('class', 'three');
$cuatro = $doc -> createElement('div', $wk_cliente);
$cuatro -> setAttribute('class', 'four');
$cinco = $doc -> createElement('div', $wk_cliente);
$cinco -> setAttribute('class', 'five');
$seis = $doc -> createElement('div', $wk_cliente);
$seis -> setAttribute('class', 'six');
$siete = $doc -> createElement('div', $wk_cliente);
$siete -> setAttribute('class', 'seven');

$lossiete -> appendChild($uno);
$lossiete -> appendChild($dos);
$lossiete -> appendChild($tres);
$lossiete -> appendChild($cuatro);
$lossiete -> appendChild($cinco);
$lossiete -> appendChild($seis);
$lossiete -> appendChild($siete);

$factura -> appendChild($lossiete);

$x++;
$wk_cliente = "Este es el " . $x . 'vo cliente';
}

$doc->saveHTMLFile($salida);
$flagMail = enviaFacturasSeleccionadas($param);
exit();
function enviaFacturasSeleccionadas($param) {
    
    require $_SERVER['DOCUMENT_ROOT'] . '/salgraf/include/enviamail.php';
    $directorio = 'file:///C:/wamp/www/Salgraf/archivos/' . $param;
    $part = '<html><head></head><body><div><b>Nombre: </b>' . $_SESSION['nombre'] . '<br><b>Apellido: </b>' . $_SESSION['apellido'] . '<br>';
    $part .= '<br><hr><br><span>Usted puede ir a esta direccion para ver el archivo </span>';
    $part .= '<br><hr><br><span>' .$directorio . '</sapn><br><br><span>Copie este link en una nueva ventana de su buscador favorito</span></div></body></html>';

    $body = 'Nombre: ' . $_SESSION['nombre'] . 'Apellido: ' . $_SESSION['apellido'] . "\r\n";
    $body .= 'Usted esta ahbilitado para utilizar el sistema de comprobantes electronicos\r\n';
    $body .= $directorio . ' Ver el archivo \r\n ';
    
    $paraemail['part'] = $part;
    $paraemail['body'] = $body;
    $paraemail['subject'] = 'Comprobantes Electronicos Facturas Seleccionadas';
    $paraemail['fromemail']['email'] = 'salgraf.sistema@gmail.com';
    $paraemail['fromemail']['nombre'] = 'Sistema';
    $paraemail['toemail']['email'] = $_SESSION['email'];
    $paraemail['toemail']['nombre'] = $_SESSION['nombre'].' '.$_SESSION['apellido'];
    
    $flagEmail = enviamail($paraemail);
    return $flagEmail;
}
