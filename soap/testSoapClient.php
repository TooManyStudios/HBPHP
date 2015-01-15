<html>
<head>
	<meta charset="utf-8">
	<title>Températures</title>
</head>
<body>	

<?php

$wsdl = "http://www.w3schools.com/webservices/tempconvert.asmx?WSDL";
$service = new SoapClient($wsdl);


$allservices = $service->__getFunctions();
echo("Functions:<br>");
echo("<pre>");
print_r($allservices);
echo("</pre>");


$alltypes = $service->__getTypes();
echo("Types:<br>");
echo("<pre>");
print_r($alltypes);
echo("</pre>");


$error = 0;
$param = array("Celsius" => 35, "Fahrenheit" => 90);
$tempF; $tempC;
try {
	//$info = $service->__soapCall("CelsiusToFahrenheit", array($param));
	$tempF = $service->CelsiusToFahrenheit($param);
	$tempC = $service->FahrenheitToCelsius($param);
} catch (SoapFault $fault) {
	$error = 1;
	echo("Error: ".$fault->faultcode." - ".$fault->faultstring."<br>");
}
echo("Conversions de températures:<br>");
echo("<pre>");
echo("35°C en F: ".$tempF->CelsiusToFahrenheitResult."<br>");
print_r($tempF);
echo("90°F en C: ".$tempC->FahrenheitToCelsiusResult."<br>");
print_r($tempC);
echo("</pre>");
?>

</body>
</html>