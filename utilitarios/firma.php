<?php

/* 
 * <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod> 
 * <ds:DigestValue><!-- HASH O DIGEST DEL ELEMENTO <etsi:SignedProperties> --></ds:DigestValue> 
 * <ds:DigestValue><!-- HASH O DIGEST DEL CERTIFICADO X509 --></ds:DigestValue> 
 <ds:DigestValue><!-- HASH O DIGEST DE TODO EL ARCHIVO XML IDENTIFICADO POR EL id="comprobante"--></ds:DigestValue>
 */

$doc = new DOMDocument();
$doc -> load('factura.xml');
$variableXML = $doc->C14N();
$digest = base64_encode(pack("H*", sha1($variableXML)));
echo $digest;
/*
 * Definicion del documento que corresponde a la firma digital
 * estamos probando con varios documentos
 */
$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root = $doc ->createElementNS("http://www.w3.org/2000/09/xmldsig#", 'ds:Signature');
$signedInfo = $doc ->createElement("ds:SignedInfo");
$canoMethod = $doc ->createElement("ds:CanonicalizationMethod");
$canoMethod ->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315");
$signatureMethod = $doc ->createElement("ds:SignatureMethod");
$signatureMethod ->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmldsig-more#rsa-sha256");
$reference = $doc ->createElement("ds:Reference");
$reference ->setAttribute("URI", "#xmldsig-aae8151c-b8db-4525-bfb1-0b3cebdd1dbf-keyinfo");
$digestMethod = $doc ->createElement("ds:DigestMethod");
$digestMethod ->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha256");

$variableXML = $signed -> C14N();
$digest1 = base64_encode(pack("H*", sha1($variableXML)));
echo $digest1;
$digestValue = $doc ->createElement("ds:DigestValue", $digest1); // HASH O DIGEST DEL ELEMENTO <etsi:SignedProperties>

$reference1 = $doc ->createElement("ds:Reference");
$reference1 ->setAttribute("URI", "#lote");
$transforms = $doc ->createElement("ds:Transforms");
$transform = $doc ->createElement("ds:Transform");
$transform ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#enveloped-signature");
$digestMethod1 = $doc ->createElement("ds:DigestMethod");
$digestMethod1 ->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha256");

$variableXML = $reference1 -> C14N();
$digest2 = base64_encode(pack("H*", sha1($variableXML)));
echo $digest2;
$digestValue1 = $doc ->createElement("ds:DigestValue", $digest2); // HASH O DIGEST DE TODO EL ARCHIVO XML IDENTIFICADO POR EL id = "lote" 
$reference2 = $doc ->createElement("ds:Reference");
$reference2 ->setAttribute("Type", "http://uri.etsi.org/01903#SignedProperties");
$reference2 ->setAttribute("URI", "#xmldsig-aae8151c-b8db-4525-bfb1-0b3cebdd1dbf-signedprops");
$digestMethod2 = $doc ->createElement("ds:DigestMethod");
$digestMethod2 ->setAttribute("Algorithm", "http://www.w3.org/2001/04/xmlenc#sha256");

$variableXML = $signed -> C14N();
$digest3 = base64_encode(pack("H*", sha1($variableXML)));
echo $digest3;
$digestValue2 = $doc ->createElement("ds:DigestValue", $digest3); // HASH O DIGEST DEL ELEMENTO <etsi:SignedProperties>

$o_signatureValue = "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDIczel8epedAoW
3/r2g9TAwGhZBHKHfixAZLuyyrcDGi+E55zg0CTQOeREogp7Li1MRAuhdclD5xbC
pIPc4eAdQnmFEuL59iIXOZBHnGbmK+1/hdfc/wGkZCMKHMSPTG9+QoAt/nVc8QKA
MQwUVhVZXjHV3Fn/X8cZHl0crERtl8yk2t70E6ugGVnD8d0QWLGhxx23mIvxK74k
29sQdz/2wNeJNUjfZeqV4jUCtGsIRo7V9Cfwr+muU7a24CDGNHzU1/HgAAe+hzUs
9dzPZGWSz26LovMeB8bPmbfmWDbg57WpXPNe6WYapYwBKmWVJNvtOvsdQ3rDLUID
9cJ21rEJAgMBAAECggEBAMUkA/vyM+WXTID44jLmryyvTzEVXaqCXfUq3StXkay8
aTXWMQUt0Lb16NnTYGmLncNfPO0cEcj1kv31nTZ089zzDt7hF1htSVP8KjkzykPf
uiHsOcRBDJVoYsnER1EEBLdxoe0aUMUKx8HZ+x5ZF4AgUvUZVW4C/aZnpX3Ysyfw
HjQd4WRaWA88D/fJAyy1eEvhOs5UvPWbVoupiI77UHMdUAjN3l6V98HoQ5bEXkn1
+QrIvMWv17O5T/VcEnVeLeS64R4uZMjtdRxMhvzKorkKlko6UZuZveAyqbQ3MXAL
9W3OENJ787Xi/LUvNjABMCsCNWy2WA4rO2nceq2JzAECgYEA/f9JB1hDNte+ogZb
TaAGCcJ+Vlb4Dt8xa2nfcMMAFVaCH+tsWr/9ZVp5zdujgyL3cooQ15WtamIjyZ2J
1SFw5pLyWmcBmk9CpTlsjK5qSgr1VTHswcX0Ov3CbvrmejM2vRG+cWgL/FeXEj4u
a8XSaLCD5gMQ/u4iQbf0fLtQkoECgYEAygfXuzex848b3iTn2sGkZQWmQWlf4fi0
TemkWTTB9ga0nEpHaQf0JHbqqrdVIvRdbLzOWUU66iPHR4eFiU61kc4wOMMAbOe1
6IjWHimrL8KY2X4/3t/qzk+sFp0kMZYdA1c+LI2nXlsNm4BIZiWTSt8RQ3kVYzOF
qrBrZVDfSokCgYBr0uyAhrJ53Jpbk9E8obsOd5dENcU2Iv+KtrYY2170r/WrcThd
SfVbCk582kmOiNB8uimuKycj6yeAFjWF2Z1g9G6Xe/TNOepz023GRuBuMDq3gOsd
01f7lu/sRuyCYa1SE+9Bm0bDR7elEeqI68CHmq9TfGfBoPu/5ESQksAAgQKBgDBT
0fIx73qAqDzqfR/iJG4Z/Nw21b3bXV4p3quMKD2u+vNL/WsNgQRcAeSWeGIlLFf/
jijim6Y4qsncjD/9OQfI19YsJ2TlxKj8WqPaed2x4hhcz/CDhcqWWmcKbgcCjqwm
6XOE6x1yEH47IJZ2tJY7aAjI5SnWwEnFa9tPjippAoGAfyi9Gsh7WOEFR46HcPvd
YxbjynlmPNziY+dpiTWggwfU9/xmnKQ1T+38lp53VXP5PxLrTEBrc+1Sw8U3JGZn
0fSzH6V17LREIq8XX2FzSUO4htyeGpFHNlD3iE2MpLEsIjuuU6YWUWHWIjZPvRje
IApQdKJ+P7/Kpsa42AaJTTE=";
$signatureValue = $doc ->createElement("ds:SignatureValue", $o_signatureValue); // VALOR DE LA FIRMA (ENCRIPTADO CON LA LLAVE PRIVADA DEL CERTIFICADO DIGITAL
$keyInfo = $doc ->createElement("ds:KeyInfo");
$x509Data = $doc ->createElement("ds:X509Data");

$o_signatureValue1 = "a9:b9:a0:e9:e1:cd:e2:bd:43:47:22:93:9c:12:30:14:bf:65:
         34:ee:c7:14:ff:b2:73:7f:aa:e9:b3:e0:ca:88:01:bc:24:03:
         de:49:19:2a:52:20:83:18:f5:62:ca:87:92:05:b5:04:bc:25:
         93:8b:78:aa:46:82:24:32:b8:c5:5a:bb:80:88:b1:21:91:90:
         b5:6c:6f:af:f8:54:1f:d2:9e:34:a7:ae:15:03:6b:c1:7b:44:
         ad:8b:40:a4:5d:00:86:d4:3d:36:64:24:da:ed:f2:58:b9:b1:
         ec:98:21:74:e3:30:00:61:d9:af:a8:09:52:9e:8d:af:b7:5f:
         c7:88:88:5a:ad:5c:6f:83:05:0b:68:87:0f:21:d7:ef:d3:65:
         e3:6c:aa:fa:4b:f3:e2:d6:e7:ad:54:ee:27:79:6d:cf:f4:5e:
         f1:7e:61:67:90:67:88:f6:78:0f:5e:d1:0f:33:2f:48:1d:71:
         92:ad:0d:1a:67:19:9b:a6:b8:fc:c5:4c:0c:29:72:2a:b1:28:
         a2:5b:c7:0d:1f:f4:5f:f1:1b:c4:96:06:9c:4a:d5:ae:1f:9b:
         92:e7:e7:23:00:8c:47:3d:9a:50:5b:bd:9f:2a:68:99:f2:fd:
         54:b5:9d:55:ab:c2:84:b0:f6:ae:f1:05:b0:03:71:33:30:27:
         8c:ab:0f:1b:a1:83:3b:ef:78:96:35:81:e0:74:92:a8:3e:16:
         db:39:70:21:a8:a5:b0:ea:14:a4:f2:c3:75:29:68:2c:cd:cc:
         ac:a8:3b:10:cf:69:b7:4c:1a:db:44:dd:bd:09:fc:d3:59:61:
         07:f5:c7:27:d9:fe:ce:be:2b:6d:ab:fc:25:3a:27:34:af:5f:
         6a:7a:68:1e:8f:b1:b0:85:06:0a:e0:23:2f:66:c8:25:cc:ab:
         2f:e4:fe:ba:bd:13:8a:78:2e:38:1b:ea:9b:95:4c:d3:b7:d1:
         3d:6e:2f:3f:14:f7:bf:c7:31:51:48:ce:ea:b2:37:86:42:79:
         96:c1:89:7c:63:68:55:9e:e3:37:10:78:2a:94:a4:f6:de:9c:
         64:ad:bf:d5:cd:10:76:d1:85:17:26:1c:17:ad:0b:b4:89:3c:
         95:25:0b:8f:de:32:ac:13:c0:b7:40:9e:7f:86:6b:d5:d5:59:
         79:01:69:89:85:35:ac:40:76:3c:a0:ad:5c:5a:2b:68:35:48:
         40:83:99:6b:1e:0a:a7:10:f6:6a:da:f3:06:59:76:91:46:5d:
         57:d4:af:b5:d7:5a:74:48:cb:9e:50:8b:87:9b:e3:25:b7:ef:
         ca:72:cf:9a:93:58:6a:c1:d5:f0:87:97:de:5a:17:f3:4e:ab:
         3a:41:f0:26:be:c9:cb:1a
";
$x509Certificate = $doc ->createElement("ds:X509Certificate", $o_signatureValue1); // CERTIFICADO X509 CODIFICADO EN Base64
$keyValue = $doc ->createElement("ds:KeyValue");
$rsaKeyValue = $doc ->createElement("ds:RSAKeyValue");
$o_modulus = "";
$modulus = $doc ->createElement("ds:Modulus"); // MODULO DEL CERTIFICADO X509 
$exponet = $doc ->createElement("ds:Exponent", "AQAB");

$rsaKeyValue ->appendChild($exponet);
$rsaKeyValue ->appendChild($modulus);
$keyValue ->appendChild($rsaKeyValue);
$x509Data ->appendChild($x509Certificate);
$keyInfo ->appendChild($keyValue);
$keyInfo ->appendChild($x509Data);

$transforms ->appendChild($transform);
$reference2 ->appendChild($digestMethod2);
$reference2 ->appendChild($digestValue2);
$reference1 ->appendChild($digestMethod1);
$reference1 ->appendChild($digestValue1);
$reference ->appendChild($digestMethod);
$reference ->appendChild($digestValue);
$signedInfo ->appendChild($reference);
$signedInfo ->appendChild($reference1);
$signedInfo ->appendChild($reference2);
$signedInfo ->appendChild($signatureMethod);
$signedInfo ->appendChild($canoMethod);

/*
 * Definicion de la firma que corresponde a "QualifyingProperties"
 */

$qualifyingProperties = $doc -> createElementNS("http://uri.etsi.org/01903/v1.3.2#",  'etsi:QualifyingProperties');
$qualifyingProperties ->setAttribute("Target", "#SignatureSalgraf");
$qualifyingProperties -> setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');

$signed = $doc -> createElementNS('etsi:SignedProperties');
$signed -> setAttribute('id', 'Salgraf-Firma');
$properties = $doc ->createElement('etsi:SignedSignatureProperties');
$o_tiempo = "";
$tiempo = $doc ->createElementNS("etsi:SigningTime", $o_tiempo);
$certificado = $doc ->createElement('etsi:SigningCertificate');
$cert = $doc ->createElement('etsi:Cert');
$certD = $doc ->createElement('etsi:CertDigest');
$digestM = $doc ->createElement('ds:DigestMethod');
$digestM ->setAttribute('Algorithm', "http://www.w3.org/2000/09/xmldsig#sha1");
/*
 * Calcular el digest value of signed properties abajo
 */
$o_digestV = " ";
$digestV = $doc ->createElement('ds:DigestValue', $o_digestV); 
$issuerSerial = $doc ->createElement('etsi:IssuerSerial');
$issuerName = $doc ->createElement('ds:X509IssuerName');
$o_issuerName = "CN = AC BANCO CENTRAL DEL ECUADOR
L = QUITO
OU = ENTIDAD DE CERTIFICACION DE INFORMACION-ECIBCE
O = BANCO CENTRAL DEL ECUADOR
C = EC";
$serialNumber = $doc ->createElement('ds:X509SerialNumber');
$o_serialNumber = "1313015603";

$signedDataObjectProperties = $doc ->createElement('etsi:SignedDataObjectProperties');
$dataObjectFormat = $doc ->createElement('etsi:DataObjectFormat');
$dataObjectFormat ->setAttribute("ObjectReference", "#Reference-ID-363558");
$o_description = "Facturas del ";
$description = $doc ->createElement('etsi:Description', $o_description);
$mimeType = $doc ->createElement('etsi:MimeType', 'text/xml');

$dataObjectFormat ->appendChild($mimeType);
$dataObjectFormat ->appendChild($description);
$signedDataObjectProperties ->appendChild($dataObjectFormat);

$variableXML = $signed -> C14N();
$o_digestV = base64_encode(pack("H*", sha1($variableXML)));
$issuerSerial ->appendChild($serialNumber);
$issuerSerial ->appendChild($issuerName);
$certD ->appendChild($digestM);
$certD ->appendChild($digestV);
$cert ->appendChild($certD);
$cert ->appendChild($issuerSerial);
$certificado ->appendChild($cert);

$properties ->appendChild($certificado);
$properties ->appendChild($tiempo);
$signed ->appendChild($properties);
$signed ->appendChild($signedDataObjectProperties);

$qualifyingProperties -> appendChild($signed);
$root ->appendChild($qualifyingProperties);
$root ->appendChild($signedInfo);
$root ->appendChild($signatureValue);
$root ->appendChild($keyInfo);
$doc -> appendChild($root);

    exit();