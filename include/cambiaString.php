<?php

/* 
 * @Author:     Juan Carrillo
 * @Date:       24 de Agosto del 2014
 * @Project:    Comprobantes electronicos
 */
/*
 * El argumento $param debe ser una array asociativa 
 */
//$args['dato'] = '1703644805001 Registro del Contribuyente';
//$args['longitud'] = 12; //debe ser -1 de la longitud deseada
//$args['vector'] = 'I'; //I=Izquierdo D=Derecho;
//$args['relleno'] = 'N'; //N=Numero A=Alfas;
//$stringDate = generaString($args);
//echo implode($stringDate);

function generaString($param) {
    $claveArray = [];
    $limite = $param['longitud'];

    for($x=0;$x<$limite;$x++) {
        $claveArray[$x] = 0;
    }
    
    $args['tabla'] = $param['dato'];
    $args['posini'] = 0;
    $args['posfin'] = $param['longitud'];
    $args['vector'] = $param['vector'];
    $args['relleno'] = $param['relleno'];
    
    if ($args['vector'] == "I") {
        $claveArray = haceIzq($args);
    } else {
        $claveArray = haceDer($args);
    }
    return $claveArray;
}

function haceDer($param) {
//    echo 'Viene ';
//    var_dump($param);
    $paso = str_split($param['tabla']);
//    var_dump($paso);
    $claveArray = [];
        $limite = $param['posfin'];
        for($x=0;$x<$limite;$x++) {
        $claveArray[$x] = 0;
        }
    $j = count($paso) - 1;
    $posini = $param['posini']; 
    $posfin = $param['posfin'];
    $flag = TRUE;
    while ($flag) 
    {
        if($posfin >= $posini){
//        echo 'Esto tiene ini ' . $posini . ' Esto tiene fin ' . $posfin;
        if ($j >= 0) {
            $claveArray[$posfin] = $paso[$j];
            if ($param['relleno'] == 'N') {
                if (!is_numeric($claveArray[$posfin])){
                    $claveArray[$posfin] = '0';
                }
            } else {
                if (is_numeric($claveArray[$posfin])) {
                    $claveArray[$posfin] = ' ';
                }
            }
                
            $j--;
        } else {
            if ($param['relleno'] == 'N') {
                $claveArray[$posfin] = '0';
            } else {
                $claveArray[$posfin] = ' ';
            }
        }
        $posfin--;
        } else {
            $flag = FALSE;
        }
    }
    return $claveArray;
}

function haceIzq($param) {
//    echo 'Viene ';
//    var_dump($param);
    $paso = str_split($param['tabla']);
    $claveArray = [];
        $limite = $param['posfin'];
        for($x=0;$x<$limite;$x++) {
        $claveArray[$x] = 0;
        }
    $j = count($paso) - 1;
    $i = 0;
    $posini = $param['posini']; 
    $posfin = $param['posfin'];
    $flag = TRUE;
    while ($flag) 
    {
        if($posini <= $posfin){
//        echo 'Esto tiene ini ' . $posini . ' Esto tiene fin ' . $posfin;
        if ($i <= $j) {
            $claveArray[$posini] = $paso[$i];
            if ($param['relleno'] == 'N') {
                if (!is_numeric($claveArray[$posini])){
                    $claveArray[$posini] = '0';
                }
            } else {
                if (is_numeric($claveArray[$posini])) {
                    $claveArray[$posini] = ' ';
                }
            }
                
            $i++;
        } else {
            if ($param['relleno'] == 'N') {
                $claveArray[$posini] = '0';
            } else {
                $claveArray[$posini] = ' ';
            }
        }
        $posini++;
        } else {
            $flag = FALSE;
        }
    }
    return $claveArray;
}
function limpiaString($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}