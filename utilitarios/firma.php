<?php
$param = "signedTemplate.xml";
$signed = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc1 = new DOMDocument();
$doc1->load($signed);
$xmlDoc = $doc1->C14N();
$digest = base64_encode(pack("H*", sha1( $xmlDoc )));
echo 'Signed Properties => ' . $digest . '<br>';
$param = "keyInfoTemplate.xml";
$key = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc2 = new DOMDocument();
$doc2->load($key);
$xmlDoc = $doc2->C14N();
$digest1 = base64_encode(pack("H*", sha1( $xmlDoc )));
echo 'Key Info => ' . $digest1 . '<br>';
$param = "comprobante.xml";
$lote = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc3 = new DOMDocument();
$doc3->load($lote);
$xmlDoc = $doc3->C14N();
$digest2 = base64_encode(pack("H*", sha1( $xmlDoc )));
echo 'Comprobantes => ' . $digest2 . '<br>';
/* 
 * <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod> 
 * <ds:DigestValue><!-- HASH O DIGEST DEL ELEMENTO <etsi:SignedProperties> --></ds:DigestValue> 
 * <ds:DigestValue><!-- HASH O DIGEST DEL CERTIFICADO X509 --></ds:DigestValue> 
 <ds:DigestValue><!-- HASH O DIGEST DE TODO EL ARCHIVO XML IDENTIFICADO POR EL id="comprobante"--></ds:DigestValue>
 */

$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root = $doc ->createElementNS("http://www.w3.org/2000/09/xmldsig#", 'ds:Signature');
$root->setAttribute('id', 'refQualifyingProperties');

$signedInfo = $doc ->createElement("ds:SignedInfo");
$canoMethod = $doc ->createElement("ds:CanonicalizationMethod");
$canoMethod ->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315");
$signatureMethod = $doc ->createElement("ds:SignatureMethod");
$signatureMethod ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#sha1");
$reference = $doc ->createElement("ds:Reference");
$reference ->setAttribute("URI", "#Salgraf-SignedProperties");
$digestMethod = $doc ->createElement("ds:DigestMethod");
$digestMethod ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#sha1");
$digestValue = $doc ->createElement("ds:DigestValue", $digest); // HASH O DIGEST DEL ELEMENTO <etsi:SignedProperties>
$reference1 = $doc ->createElement("ds:Reference");
$reference1 ->setAttribute("URI", "#keyInfo");
$transforms = $doc ->createElement("ds:Transforms");
$transform = $doc ->createElement("ds:Transform");
$transform ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#enveloped-signature");
$digestMethod1 = $doc ->createElement("ds:DigestMethod");
$digestMethod1 ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#sha1");
$digestValue1 = $doc ->createElement("ds:DigestValue", $digest1); // HASH O DIGEST DEL ELEMENTO <ds:Keyigo> 
$reference2 = $doc ->createElement("ds:Reference");
$reference2 ->setAttribute("Type", "http://uri.etsi.org/01903#SignedProperties");
$reference2 ->setAttribute("URI", "#comprobante");
$digestMethod2 = $doc ->createElement("ds:DigestMethod");
$digestMethod2 ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#sha1");
$digestValue2 = $doc ->createElement("ds:DigestValue", $digest2); // HASH O DIGEST DEL ELEMENTO <comprobantes>

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

$transforms ->appendChild($transform);
$reference ->appendChild($digestMethod);
$reference ->appendChild($digestValue);
$reference1 ->appendChild($digestMethod1);
$reference1 ->appendChild($digestValue1);
$reference2 ->appendChild($transforms);
$reference2 ->appendChild($digestMethod2);
$reference2 ->appendChild($digestValue2);
$signedInfo ->appendChild($canoMethod);
$signedInfo ->appendChild($signatureMethod);
$signedInfo ->appendChild($reference);
$signedInfo ->appendChild($reference1);
$signedInfo ->appendChild($reference2);

$root ->appendChild($signedInfo);
$root ->appendChild($signatureValue);

$doc ->appendChild($root);
/*
 * Poner en $param el tipo de comprobante que se esta firmando
 */
$param = "firmaTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();