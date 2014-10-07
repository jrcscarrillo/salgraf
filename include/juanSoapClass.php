<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class juanSoapClass extends SoapClient {

    function __doRequest($request, $location, $action, $version) {
        $namespace = "http://ec.gob.sri.ws.recepcion";

        $request = preg_replace('/<ns1:(\w+)/', '<$1 xmlns="'.$namespace.'"', $request, 1);
        $request = preg_replace('/<ns1:(\w+)/', '<$1', $request);
        $request = str_replace(array('/ns1:', 'xmlns:ns1="'.$namespace.'"'), array('/', ''), $request);

        // parent call
        return parent::__doRequest($request, $location, $action, $version);
    }
}

