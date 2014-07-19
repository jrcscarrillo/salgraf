<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $telefono;
    private $direccion;
    
    function __construct() {
        $this->id = 0;
        $this->nombre = "";
        $this->apellido = "";
        $this->email = "";
        $this->telefono = "";
        $this->direccion = "";
    }
    function nuevoUsuario($param) {
        
    }
}
