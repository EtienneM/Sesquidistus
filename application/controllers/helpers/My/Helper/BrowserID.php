<?php

/**
 * Simple implementation of Mozilla BrowserID
 *
 * @author emichon
 */
class My_Helper_BrowserID extends Zend_Controller_Action_Helper_Abstract {
	/**
	* The browserID's assertion verification service endpoint
	*/
	const endpoint = 'https://verifier.login.persona.org/verify';

	private $assertion;

	/**
	 * 
	 * @param String $assertion Given by the persona lib
	 * @throws Zend_Exception
	 */
	public function __construct($assertion = null) {
		if ($assertion === null) {
			throw new Zend_Exception('The assertion must be defined');
		}
		$this->assertion = $assertion;
	}

	/**
	* Makes an HTTP POST Request to verification endpoint
	* @param String Endpoint Server
	* @param Array the data to be sent to the endpoint
	* @return Object returns an object verification response
	* @private access
	*/
	private function _requestPOST($data) {
		$url = self::endpoint;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$response = curl_exec($ch);
		$infos = curl_getinfo($ch);
		curl_close($ch);

		if(false === $response) {
			throw new Exception(sprintf("Failed to connect to the %s verifier", $url));
		}

		$json_decoded = Zend_Json::decode($response, Zend_Json::TYPE_OBJECT);

		if(!$json_decoded) {
			throw new Exception(sprintf("JSON Response from %s is not valid", $url));
		}
		return $json_decoded;
	}

	/**
	* With this method you must verify the assertion is authentic and extract the email address from it.
	* @public access
	* @return JSON - returns an object as response from service with the following attributes:
	* 1)status okay | failure
	* 2)email bob@example.com if succesful
	* 2)reason if not fail
	*/
	public function verifyAssertion() {
		$request = $this->getRequest();
		$assertion = $request->getParam('assertion');
		$params = Zend_Json::encode(array('assertion'=>$assertion, 'audience'=>$_SERVER['HTTP_HOST']));
		$output = $this->_requestPOST($params);
		if(isset($output->status) && $output->status == 'okay') {
			// $this->email   = $output->email;
			// $this->expires = $output->expires;
			// $this->issuer  = $output->issuer;
			return Zend_Json::encode(array('status' => 'okay', 'email' => $output->email));
		} else {
			// $this->reason = $output->reason;
			return Zend_Json::encode(array('status' => 'failure', 'reason' => $output->reason));
		}
	}
}