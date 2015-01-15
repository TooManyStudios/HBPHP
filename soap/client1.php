<?php
// client - sans WSDL
$options = array(
	//'uri' => 'http://localhost/soap/namespace_test',
	'uri' => 'test',
	'location' => 'http://localhost/soap/server1.php'
);

$client = new SoapClient(null, $options);
echo($client->add(3, 17));