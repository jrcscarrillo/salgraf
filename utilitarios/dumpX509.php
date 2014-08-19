<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$param = "juancarrillo.pem";
$salida = "C:/OpenSSL-Win32/bin/" . $param; 
  $certs = array();
  $pkcs12 = file_get_contents( $salida );
  // No password
  openssl_pkcs12_read( $pkcs12, $certs, "" );
  print_r( $certs );
//$data = openssl_x509_parse(file_get_contents($salida));
//
//print_r(array_values($data)); 
//print_r(array_keys($data));
    