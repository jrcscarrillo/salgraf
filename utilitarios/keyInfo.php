<?php
$doc = new DOMDocument();
$doc -> formatOutput = TRUE;
$root = $doc ->createElementNS("http://www.w3.org/2000/09/xmldsig#", 'ds:Keyinfo');
$root->setAttribute('id', 'keyInfo');
$x509Data = $doc ->createElement("ds:X509Data");

//$o_signatureValue1 = "a9:b9:a0:e9:e1:cd:e2:bd:43:47:22:93:9c:12:30:14:bf:65:
//         34:ee:c7:14:ff:b2:73:7f:aa:e9:b3:e0:ca:88:01:bc:24:03:
//         de:49:19:2a:52:20:83:18:f5:62:ca:87:92:05:b5:04:bc:25:
//         93:8b:78:aa:46:82:24:32:b8:c5:5a:bb:80:88:b1:21:91:90:
//         b5:6c:6f:af:f8:54:1f:d2:9e:34:a7:ae:15:03:6b:c1:7b:44:
//         ad:8b:40:a4:5d:00:86:d4:3d:36:64:24:da:ed:f2:58:b9:b1:
//         ec:98:21:74:e3:30:00:61:d9:af:a8:09:52:9e:8d:af:b7:5f:
//         c7:88:88:5a:ad:5c:6f:83:05:0b:68:87:0f:21:d7:ef:d3:65:
//         e3:6c:aa:fa:4b:f3:e2:d6:e7:ad:54:ee:27:79:6d:cf:f4:5e:
//         f1:7e:61:67:90:67:88:f6:78:0f:5e:d1:0f:33:2f:48:1d:71:
//         92:ad:0d:1a:67:19:9b:a6:b8:fc:c5:4c:0c:29:72:2a:b1:28:
//         a2:5b:c7:0d:1f:f4:5f:f1:1b:c4:96:06:9c:4a:d5:ae:1f:9b:
//         92:e7:e7:23:00:8c:47:3d:9a:50:5b:bd:9f:2a:68:99:f2:fd:
//         54:b5:9d:55:ab:c2:84:b0:f6:ae:f1:05:b0:03:71:33:30:27:
//         8c:ab:0f:1b:a1:83:3b:ef:78:96:35:81:e0:74:92:a8:3e:16:
//         db:39:70:21:a8:a5:b0:ea:14:a4:f2:c3:75:29:68:2c:cd:cc:
//         ac:a8:3b:10:cf:69:b7:4c:1a:db:44:dd:bd:09:fc:d3:59:61:
//         07:f5:c7:27:d9:fe:ce:be:2b:6d:ab:fc:25:3a:27:34:af:5f:
//         6a:7a:68:1e:8f:b1:b0:85:06:0a:e0:23:2f:66:c8:25:cc:ab:
//         2f:e4:fe:ba:bd:13:8a:78:2e:38:1b:ea:9b:95:4c:d3:b7:d1:
//         3d:6e:2f:3f:14:f7:bf:c7:31:51:48:ce:ea:b2:37:86:42:79:
//         96:c1:89:7c:63:68:55:9e:e3:37:10:78:2a:94:a4:f6:de:9c:
//         64:ad:bf:d5:cd:10:76:d1:85:17:26:1c:17:ad:0b:b4:89:3c:
//         95:25:0b:8f:de:32:ac:13:c0:b7:40:9e:7f:86:6b:d5:d5:59:
//         79:01:69:89:85:35:ac:40:76:3c:a0:ad:5c:5a:2b:68:35:48:
//         40:83:99:6b:1e:0a:a7:10:f6:6a:da:f3:06:59:76:91:46:5d:
//         57:d4:af:b5:d7:5a:74:48:cb:9e:50:8b:87:9b:e3:25:b7:ef:
//         ca:72:cf:9a:93:58:6a:c1:d5:f0:87:97:de:5a:17:f3:4e:ab:
//         3a:41:f0:26:be:c9:cb:1a
//";
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
//$o_modulus = "00:c8:73:37:a5:f1:ea:5e:74:0a:16:df:fa:f6:83:
//                    d4:c0:c0:68:59:04:72:87:7e:2c:40:64:bb:b2:ca:
//                    b7:03:1a:2f:84:e7:9c:e0:d0:24:d0:39:e4:44:a2:
//                    0a:7b:2e:2d:4c:44:0b:a1:75:c9:43:e7:16:c2:a4:
//                    83:dc:e1:e0:1d:42:79:85:12:e2:f9:f6:22:17:39:
//                    90:47:9c:66:e6:2b:ed:7f:85:d7:dc:ff:01:a4:64:
//                    23:0a:1c:c4:8f:4c:6f:7e:42:80:2d:fe:75:5c:f1:
//                    02:80:31:0c:14:56:15:59:5e:31:d5:dc:59:ff:5f:
//                    c7:19:1e:5d:1c:ac:44:6d:97:cc:a4:da:de:f4:13:
//                    ab:a0:19:59:c3:f1:dd:10:58:b1:a1:c7:1d:b7:98:
//                    8b:f1:2b:be:24:db:db:10:77:3f:f6:c0:d7:89:35:
//                    48:df:65:ea:95:e2:35:02:b4:6b:08:46:8e:d5:f4:
//                    27:f0:af:e9:ae:53:b6:b6:e0:20:c6:34:7c:d4:d7:
//                    f1:e0:00:07:be:87:35:2c:f5:dc:cf:64:65:92:cf:
//                    6e:8b:a2:f3:1e:07:c6:cf:99:b7:e6:58:36:e0:e7:
//                    b5:a9:5c:f3:5e:e9:66:1a:a5:8c:01:2a:65:95:24:
//                    db:ed:3a:fb:1d:43:7a:c3:2d:42:03:f5:c2:76:d6:
//                    b1:09
//";
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