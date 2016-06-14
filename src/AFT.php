<?php

namespace Knox\AFT;

use Knox\AFT\AfricasTalkingGateway;
use Knox\AFT\Exceptions\ATFException;

class AFT{

	static $gateway;
	static $apikey;
	static $username;

	public static function initialise(){
		self::$username = config('aft.username');
		self::$apikey = config('aft.apikey');
		self::$gateway = new AfricasTalkingGateway(self::$username, self::$apikey);
	}


	public static function sendMessage($recipients, $message, $from = null, $bulkSMSMode = 1, $options = array()) {
		self::initialise();
		try{

			$results = self::$gateway->sendMessage($recipients, $message, $from, $bulkSMSMode, $options);

			return $results;
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  throw new ATFException("Encountered an error while sending: ".$e->getMessage());
		}
	}

	public function fetchMessages(){
		self::initialise();

		$data = array();
		$lastReceivedId = 0;

		try{
			do {
			    $results = self::$gateway->fetchMessages($lastReceivedId);
			    foreach($results as $result) {
			    	$arr = array(
							      "from" => $result->from,
							      "to" => $result->to,
							      "message"  => $result->text,
							      "data_sent" => $result->date,
							      "link_id" => $result->linkId,
							      "id" => $result->id
							      );
			    	array_push($data, $arr);
			        $lastReceivedId = $result->id;   
			    }
			} while ( count($results) > 0 );

			return $data;
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  throw new ATFException("Encountered an error while receiving messages: ".$e->getMessage());
		}
	}

}