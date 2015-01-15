<?php
// serveur - avec WSDL

/**
 * Petit webservice qui fournit des fonctions de transformation de texte
 * 
 * @service TextService
 */
class TextService {

	/**
	 * @param string $input Some text (or an empty string)
	 * @return string Response string
	 */
	public function getRot13($input) {
		return str_rot13($input);
	}
	
	/**
	 * @param string $input Some text (or an empty string)
	 * @return string Response string
	 */
	public function getMirror($input) {
		return strrev($input);
	}
	
}

ini_set("soap.wsdl_cache_enabled", "0");

$server = new SoapServer('http://localhost/soap/service2.wsdl');
$server->setObject(new TextService());
$server->handle();