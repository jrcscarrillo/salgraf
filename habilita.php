<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if ((!isset($_SESSION['carrillosteam'])) or (!isset($_SESSION['email']))){
    echo 'NO';
} else {
    if (($_SESSION['carrillosteam'] == 'carrillosteam') and ($_SESSION['email'] == 'jrcscarrillo@gmail.com')) {
        require ('habilita.html');
        echo 'OK';
        exit();
        } else {
            echo 'ADMIN';
        }
        }
 