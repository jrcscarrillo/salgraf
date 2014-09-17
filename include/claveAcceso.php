<?php

/* 
 * @Author:     Juan Carrillo
 * @Date:       27 de Julio del 2014
 * @Project:    Comprobantes electronicos
 */
/*
 * El argumento $param debe ser una array asociativa 
 */
//$args['fecha'] = '02062014';
//$args['tipodoc'] = '01';
//$args['ruc'] = '1792067464001';
//$args['ambiente'] = '2';
//$args['establecimiento'] = '001';
//$args['punto'] = '001';
//$args['factura'] = '000039540';
//$args['codigo'] = '00039540';
//$args['emision'] = '1';
//$claveArray = [];
//$claveArray = generaClave($args);
//echo 'Esta es la resultante ';
//var_dump($claveArray);
//$digito = poneDigito($claveArray);
//echo 'Este es el digito autoverificador => ' . $digito;
function poneDigito($param) {
    $posfin = 47;
    $flag = TRUE;
    $j = 2;
    $suma = 0;
    while ($flag) {
        if ($posfin >= 0) {
            $suma = $suma + ($param[$posfin] * $j);
//            echo $suma;
            $j++;
            if ($j > 7) {
                $j = 2;
            }
            $posfin--;
        } else {
            $flag = FALSE;
        }
    }
//    echo 'Esta es la suma ' . $suma;
    $tienecero = $suma % 11;
    if ($tienecero == 0){
        $digito = 0;
    } else {
        $digito = 11 - ($suma % 11);
    }
//    echo '<br>Este es el digito verificador ' . $digito;
    return $digito;
}
function generaClave($param) {
    $claveArray = [];
/*
 * Generar con ceros la tabla de hasta 49 posiciones
 */
for($x=0;$x<49;$x++) {
  $claveArray[$x] = 0;
}
/*
 * Proceso de convertir cada campo en array para adicionar a la array de la clave
 */

$args['tabla'] = $param['fecha'];
$args['posini'] = 0;
$args['posfin'] = 7;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);
//echo 'Pasa fecha';

$args['tabla'] = $param['tipodoc'];
$args['posini'] = 8;
$args['posfin'] = 9;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);
//echo 'Pasa tipo documento';

$args['tabla'] = $param['ruc'];
$args['posini'] = 10;
$args['posfin'] = 22;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);
//echo 'Pasa ruc';


$args['tabla'] = $param['ambiente'];
$args['posini'] = 23;
$args['posfin'] = 23;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);



$args['tabla'] = $param['establecimiento'];
$args['posini'] = 24;
$args['posfin'] = 26;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);



$args['tabla'] = $param['punto'];
$args['posini'] = 27;
$args['posfin'] = 29;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);



$args['tabla'] = $param['factura'];
$args['posini'] = 30;
$args['posfin'] = 38;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);



$args['tabla'] = $param['codigo'];
$args['posini'] = 39;
$args['posfin'] = 46;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);



$args['tabla'] = $param['emision'];
$args['posini'] = 47;
$args['posfin'] = 47;
$args['claveArray'] = $claveArray;
$claveArray = haceArray($args);
$digito = poneDigito($claveArray);
$claveArray[48] = $digito;
return $claveArray;
}

function haceArray($param) {
//    echo 'Viene ';
//    var_dump($param);
    $paso = str_split($param['tabla']);
    
    $j = count($paso) - 1;
    $posini = $param['posini']; 
    $posfin = $param['posfin'];
    $claveArray = $param['claveArray'];
    $flag = TRUE;
    while ($flag) 
    {
        if($posfin >= $posini){
//        echo 'Esto tiene ini ' . $posini . ' Esto tiene fin ' . $posfin;
        if ($j >= 0) {
            $claveArray[$posfin] = $paso[$j];    
            $j--;
        }
        $posfin--;
        } else {
            $flag = FALSE;
        }
    }
    return $claveArray;
}