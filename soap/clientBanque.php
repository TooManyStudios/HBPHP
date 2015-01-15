<?php
// client - avec WSDL
ini_set("soap.wsdl_cache_enabled", "0");

$client = new SoapClient('http://localhost:8585/?wsdl');

echo(rand() . "<hr>");
$euro = 21;
$dirham = $client->convertirEnDirham(array("montant"=>$euro));
//$dirham = $client->conversion(array("mt"=>$euro));
print("$euro euros = " . $dirham->return . " dirhams<br>");

$numeroCompte = 2;
$compte = $client->getCompte(array("arg0"=>$numeroCompte, "nimp"=>54545));
print("<br>Compte $numeroCompte:<br>");
print("<pre>");print_r($compte);print("</pre>");

echo("Solde sur le compte $numeroCompte : " . $compte->return->solde);