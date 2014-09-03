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
//$param = "comprobante.xml";
//$lote = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
//$doc3 = new DOMDocument();
//$doc3->load($lote);
//$xmlDoc = $doc3->C14N();
//$digest2 = base64_encode(pack("H*", sha1( $xmlDoc )));
//echo 'Comprobantes => ' . $digest2 . '<br>';
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
//$reference2 = $doc ->createElement("ds:Reference");
//$reference2 ->setAttribute("Type", "http://uri.etsi.org/01903#SignedProperties");
//$reference2 ->setAttribute("URI", "#comprobante");
//$digestMethod2 = $doc ->createElement("ds:DigestMethod");
//$digestMethod2 ->setAttribute("Algorithm", "http://www.w3.org/2000/09/xmldsig#sha1");
//$digestValue2 = $doc ->createElement("ds:DigestValue", $digest2); // HASH O DIGEST DEL ELEMENTO <comprobantes>

//$o_signatureValue = "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDIczel8epedAoW
//3/r2g9TAwGhZBHKHfixAZLuyyrcDGi+E55zg0CTQOeREogp7Li1MRAuhdclD5xbC
//pIPc4eAdQnmFEuL59iIXOZBHnGbmK+1/hdfc/wGkZCMKHMSPTG9+QoAt/nVc8QKA
//MQwUVhVZXjHV3Fn/X8cZHl0crERtl8yk2t70E6ugGVnD8d0QWLGhxx23mIvxK74k
//29sQdz/2wNeJNUjfZeqV4jUCtGsIRo7V9Cfwr+muU7a24CDGNHzU1/HgAAe+hzUs
//9dzPZGWSz26LovMeB8bPmbfmWDbg57WpXPNe6WYapYwBKmWVJNvtOvsdQ3rDLUID
//9cJ21rEJAgMBAAECggEBAMUkA/vyM+WXTID44jLmryyvTzEVXaqCXfUq3StXkay8
//aTXWMQUt0Lb16NnTYGmLncNfPO0cEcj1kv31nTZ089zzDt7hF1htSVP8KjkzykPf
//uiHsOcRBDJVoYsnER1EEBLdxoe0aUMUKx8HZ+x5ZF4AgUvUZVW4C/aZnpX3Ysyfw
//HjQd4WRaWA88D/fJAyy1eEvhOs5UvPWbVoupiI77UHMdUAjN3l6V98HoQ5bEXkn1
//+QrIvMWv17O5T/VcEnVeLeS64R4uZMjtdRxMhvzKorkKlko6UZuZveAyqbQ3MXAL
//9W3OENJ787Xi/LUvNjABMCsCNWy2WA4rO2nceq2JzAECgYEA/f9JB1hDNte+ogZb
//TaAGCcJ+Vlb4Dt8xa2nfcMMAFVaCH+tsWr/9ZVp5zdujgyL3cooQ15WtamIjyZ2J
//1SFw5pLyWmcBmk9CpTlsjK5qSgr1VTHswcX0Ov3CbvrmejM2vRG+cWgL/FeXEj4u
//a8XSaLCD5gMQ/u4iQbf0fLtQkoECgYEAygfXuzex848b3iTn2sGkZQWmQWlf4fi0
//TemkWTTB9ga0nEpHaQf0JHbqqrdVIvRdbLzOWUU66iPHR4eFiU61kc4wOMMAbOe1
//6IjWHimrL8KY2X4/3t/qzk+sFp0kMZYdA1c+LI2nXlsNm4BIZiWTSt8RQ3kVYzOF
//qrBrZVDfSokCgYBr0uyAhrJ53Jpbk9E8obsOd5dENcU2Iv+KtrYY2170r/WrcThd
//SfVbCk582kmOiNB8uimuKycj6yeAFjWF2Z1g9G6Xe/TNOepz023GRuBuMDq3gOsd
//01f7lu/sRuyCYa1SE+9Bm0bDR7elEeqI68CHmq9TfGfBoPu/5ESQksAAgQKBgDBT
//0fIx73qAqDzqfR/iJG4Z/Nw21b3bXV4p3quMKD2u+vNL/WsNgQRcAeSWeGIlLFf/
//jijim6Y4qsncjD/9OQfI19YsJ2TlxKj8WqPaed2x4hhcz/CDhcqWWmcKbgcCjqwm
//6XOE6x1yEH47IJZ2tJY7aAjI5SnWwEnFa9tPjippAoGAfyi9Gsh7WOEFR46HcPvd
//YxbjynlmPNziY+dpiTWggwfU9/xmnKQ1T+38lp53VXP5PxLrTEBrc+1Sw8U3JGZn
//0fSzH6V17LREIq8XX2FzSUO4htyeGpFHNlD3iE2MpLEsIjuuU6YWUWHWIjZPvRje
//IApQdKJ+P7/Kpsa42AaJTTE=";
$o_signatureValue = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCSk+QyNX8XsYiT
KBAZURtDJOzAjQEkanb/h45vdwTcBS8VUgZsd9L2kwFsLwXcEM91CWFVgMmjzyod
JKybCpdZpDfeePl7AjAqd4BY/VjzZSbmTjIugKj+p5EI0qG0xbHIFR9N3oKDmwOk
zs1pskDg4/8bE+Mt9JsmlXjQwBwCSuBjxzAa/Y10OzNr1uhGpjAXC2tFxS1G754A
zzwjYQz14hi+p6kleR3w5ClhcZRUuDiTpfFTHnQ3Q3Vn5AzDQ/FeSk0jgr1a4NpK
+m52LSwBzoZykKmHszAkz+21Sn5/X04IJBT1T6aPhFqfP7xLp5cQrjmLmEWD0tNk
7yIXcdRxAgMBAAECggEACzEXn23OQnTfxLyuXgB/YGUVXq5lg+5NH72t9nzT9ii/
K5WTv/x2MzWOSkBc5iyyanFI6UpoGwXaZVdDhqMMY1/SlD4QboAARX3SYvkVLaBv
k+4sjrhsLuWEgXPzvOXLaUeTmFKBDKNtZ8wSixt9MK63781Y701Z+1w2WVoRyWro
miNvFv3hqxkIcV8Qq8KApsqkgo+TqI6jGmRoEE1vl3WX/XXhXl4npFgIUG52rmj5
wmcv91iVBwJG4LkNOvXwQyEr9GdhM2Q88fxX2KebYigI4L3gUKmWrgBVIHPQ4SQK
OIpj+IeHmj2YiE61tXN6dySysaxvGwsjFNDuiB7vcQKBgQDDFNKwOBMucrt7pguF
GHBxkN74H7/qE6z4A/m94FkvunpDknWklhJ0q78rhWiXWPHx8HKU00wdzSEehPZw
NgEixQwBJb9JnIwS7PVL8WDe0YUeGI4NiR+gvEuTBagBRX+u6GHe1BCw4kbWSEWI
OKNLgsAiqRA1ugx2P1lIHrhhMwKBgQDAWZglUCQ/2d2rXxecvlDwmANah9UPNzxS
cYBxicIWsGWcIKPbAZzJeYxMnulQopIVwt7uEhvIavz/wzaRF27X9Q07IWd9A9V6
T2zKrcDXBfTxNqv+f88km+5mg8tZKUA+GMUM2T1Q2pu2YNayvGUXpbXs0CipSske
vDJue9I7ywKBgBK4X9N7PhP5/JXMBFT8WGX9gfgLi+4Zf0K5lvCqo8RZv7vWRSXL
JPA/PvQdNEE5ztXpvgUcFbTSZ3g3SDLSa997S0Cc77NPq31xccSc4C/hqUWPE6qm
2vsgtpvgMhQVKECPmjy42vUucZ/Eha+hx8HKRUfOM3kEZoe+YoHyOL1TAoGARauu
GkXO+3m0evA0o0ekFaFaBZ6Ro7NEHDCUb4uQS5uVEloYP6lz2t413ULqC5T3CP7O
tLjGa2+lOBbDWwZ71akjI7nTvEp5NpYyN6972+aCdCRzY/lzVDVOwr8WFrOEW3mp
ViARv4mPQR4OZisrCsew/5feQoOeGY3dTnt3CMUCgYBD4y17oF+9p3/gc87iTwcT
ickDrLnNcswQ9hh58sDixhhS8rDz05cAZCBd9P3QPjDGXxrlQy7tCkyFC19zPVLI
zzgURi9p5KJchf51nHi2cRBQtuSk37UUUjJCZazcYXvAkfT6pUneIkI2ancw/6DH
W+sEfzO5mLhdMVnl6auXAw==";
$signatureValue = $doc ->createElement("ds:SignatureValue", $o_signatureValue); // VALOR DE LA FIRMA (ENCRIPTADO CON LA LLAVE PRIVADA DEL CERTIFICADO DIGITAL

$transforms ->appendChild($transform);
$reference ->appendChild($digestMethod);
$reference ->appendChild($digestValue);
$reference1 ->appendChild($digestMethod1);
$reference1 ->appendChild($digestValue1);
//$reference2 ->appendChild($transforms);
//$reference2 ->appendChild($digestMethod2);
//$reference2 ->appendChild($digestValue2);
$signedInfo ->appendChild($canoMethod);
$signedInfo ->appendChild($signatureMethod);
$signedInfo ->appendChild($reference);
$signedInfo ->appendChild($reference1);
//$signedInfo ->appendChild($reference2);

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