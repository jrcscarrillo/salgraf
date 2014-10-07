<?php
$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root = $doc ->createElementNS("http://www.w3.org/2000/09/xmldsig#", 'ds:Keyinfo');
$root->setAttribute('id', 'keyInfo');
$x509Data = $doc ->createElement("ds:X509Data");

$o_signatureValue1 = "10:cd:69:53:07:ba:02:57:86:9e:2a:4b:4b:2f:48:6a:dc:e3:
         04:47:51:3e:88:a8:05:ec:11:3b:5e:66:7b:84:0e:9c:e1:ed:
         ca:11:6a:42:ce:4d:17:99:d4:9e:6b:3b:62:a4:00:ab:32:2b:
         49:23:fe:4f:ba:67:a1:ed:fa:75:8a:a2:92:d1:5b:97:01:70:
         b3:bc:e6:7a:d1:24:cc:67:fb:66:48:fc:cc:8d:9f:27:08:6a:
         e0:3b:22:6b:93:23:26:9f:6a:b4:85:2f:46:de:20:40:61:24:
         4d:5b:fe:1a:80:80:16:96:3b:8e:af:77:81:1e:f3:bf:9b:2b:
         6b:66:93:2c:51:e9:05:f2:b9:39:a5:cb:30:3f:c7:f8:8c:3a:
         21:5a:dc:81:ca:4a:46:f4:ac:e9:41:29:5d:f8:f9:b9:7f:dc:
         03:39:99:9d:29:ae:9e:44:73:48:02:de:46:c8:b4:8a:64:0c:
         c4:ec:56:1b:90:c7:53:cb:c9:50:f6:9d:e9:0d:d9:42:f5:3d:
         0f:41:a3:9f:62:d0:08:0f:2a:dd:36:e4:a0:38:c9:62:49:85:
         c5:af:73:58:19:06:29:ed:e7:bf:a4:0c:cf:00:5c:36:49:fb:
         42:6b:09:db:b0:cb:a4:f7:b5:1a:b8:59:54:e9:78:3b:32:3f:
         b4:fd:a4:d1:35:3c:4d:3a:e6:24:87:69:fd:0b:9f:ba:62:ca:
         38:5c:65:cf:df:a9:13:83:57:b0:f8:c5:03:ed:23:e2:f6:98:
         64:ed:23:a8:0d:12:a6:e9:0e:a8:2d:76:21:f4:4a:d6:26:b7:
         ea:e2:ac:a9:e2:7b:a9:98:2e:9d:38:22:d2:01:1a:19:72:f9:
         df:db:20:5d:fc:fa:3f:1e:e5:d0:ef:68:e2:11:b2:25:f0:f1:
         40:8a:de:39:9c:dd:b2:c3:78:82:7a:01:6b:85:6d:41:ce:00:
         77:69:1a:fb:23:59:17:da:65:5c:ab:d2:97:db:a1:68:f6:86:
         92:bb:2d:e5:73:e3:96:af:94:21:74:3b:70:79:32:23:37:0a:
         5b:84:6c:ea:7c:cb:ef:41:4c:2d:4f:e7:83:4f:f7:da:f7:03:
         8d:e0:b8:d0:f6:17:38:78:ee:06:3b:d8:c3:43:98:4f:31:ef:
         45:3f:07:7f:d9:e6:9d:d6:01:f4:0a:84:6c:7f:00:82:b5:99:
         d6:e4:2a:28:49:0a:cf:ac:5c:1a:87:22:63:f0:32:af:34:17:
         3c:c1:eb:96:66:1b:30:af:23:30:86:ea:ea:18:20:dd:e7:f8:
         e2:4b:d7:19:d3:e5:be:32:5d:eb:28:96:c2:dd:d0:1b:3f:2a:
         54:36:45:6d:49:72:b8:17
";
$x509Certificate = $doc ->createElement("ds:X509Certificate", $o_signatureValue1); // CERTIFICADO X509 CODIFICADO EN Base64
$keyValue = $doc ->createElement("ds:KeyValue");
$rsaKeyValue = $doc ->createElement("ds:RSAKeyValue");

$o_modulus = "00:92:93:e4:32:35:7f:17:b1:88:93:28:10:19:51:
                    1b:43:24:ec:c0:8d:01:24:6a:76:ff:87:8e:6f:77:
                    04:dc:05:2f:15:52:06:6c:77:d2:f6:93:01:6c:2f:
                    05:dc:10:cf:75:09:61:55:80:c9:a3:cf:2a:1d:24:
                    ac:9b:0a:97:59:a4:37:de:78:f9:7b:02:30:2a:77:
                    80:58:fd:58:f3:65:26:e6:4e:32:2e:80:a8:fe:a7:
                    91:08:d2:a1:b4:c5:b1:c8:15:1f:4d:de:82:83:9b:
                    03:a4:ce:cd:69:b2:40:e0:e3:ff:1b:13:e3:2d:f4:
                    9b:26:95:78:d0:c0:1c:02:4a:e0:63:c7:30:1a:fd:
                    8d:74:3b:33:6b:d6:e8:46:a6:30:17:0b:6b:45:c5:
                    2d:46:ef:9e:00:cf:3c:23:61:0c:f5:e2:18:be:a7:
                    a9:25:79:1d:f0:e4:29:61:71:94:54:b8:38:93:a5:
                    f1:53:1e:74:37:43:75:67:e4:0c:c3:43:f1:5e:4a:
                    4d:23:82:bd:5a:e0:da:4a:fa:6e:76:2d:2c:01:ce:
                    86:72:90:a9:87:b3:30:24:cf:ed:b5:4a:7e:7f:5f:
                    4e:08:24:14:f5:4f:a6:8f:84:5a:9f:3f:bc:4b:a7:
                    97:10:ae:39:8b:98:45:83:d2:d3:64:ef:22:17:71:
                    d4:71
";
$modulus = $doc ->createElement("ds:Modulus", $o_modulus); // MODULO DEL CERTIFICADO X509 
$exponet = $doc ->createElement("ds:Exponent", "65537");

$rsaKeyValue ->appendChild($modulus);
$rsaKeyValue ->appendChild($exponet);
$keyValue ->appendChild($rsaKeyValue);
$x509Data ->appendChild($x509Certificate);
$root ->appendChild($x509Data);
$root ->appendChild($keyValue);
$doc -> appendChild($root);
/*
 * Poner en $param el tipo de comprobante que se esta firmando
 */
$param = "keyInfoTemplate.xml";
$salida = $_SERVER['DOCUMENT_ROOT'] . 'salgraf/archivos/' . $param;
$doc->save($salida);
    exit();