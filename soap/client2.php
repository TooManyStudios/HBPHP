<?php
// client - avec WSDL
ini_set("soap.wsdl_cache_enabled", "0");

$client = new SoapClient('http://localhost/soap/service2.wsdl');

// FONCTIONNERAIT SI ON AVAIT RÉUSSI À GÉNÉRER UN WSDL EN PARSANT server2.php

$origText = "exemple de chaine";
print("Original text: $origText\n");

$mirrorText = $client->getMirror($origText);
print("Mirrored text: $mirrorText\n");

$rot13Text = $client->getRot13($origText);
print("Rot13 text: $rot13Text\n");