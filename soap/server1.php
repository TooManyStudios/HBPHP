<?php
// serveur - sans WSDL
class MyService {

	public function add($x, $y) {
		return $x + $y;
	}
}

$options = array(
	'uri' => 'test',
	'location' => 'http://localhost/soap/server1.php'
);

$server = new SoapServer(null, $options);
$server->setObject(new MyService());
$server->handle();