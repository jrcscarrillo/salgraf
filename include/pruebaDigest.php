<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$param = 'factura.xml';
$archivo = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/include/' . $param;
$request = new DOMDocument();
$request->load($archivo);
$expectedDigest = '1234567890123456789012345678';
testCreateDigest($request, $expectedDigest);

function testCreateDigest(DOMDocument $request, $expectedDigest) {

    $ns = $request->documentElement->namespaceURI;
    $body = $request
        ->getElementsByTagNameNS($ns, 'Factura' )
        ->item(0);

    $content = $body->C14N(true, true); // <-- exclusive, with comments

    $actualDigest = base64_encode(hash('SHA1', $content, true));

    $this->assertEquals($expectedDigest, $actualDigest);

}