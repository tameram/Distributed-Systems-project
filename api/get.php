<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once './Db.php';
include_once './CountryCode.php';


//>> THE PAY LOAD IS CODE FILE, BF7S EL MESHTNE YKY ESMO CODE 
if (isset($_GET['code'])) {
	
	$requested_code = $_GET['code'] . "";
	//echo 'requested code: '.$requested_code;
	// instantiate database and department object
	$database = new Db();
	$db = $database->getConnection();

	// initialize object
	$countrycode = new CountryCode($db);

	//$request_body = file_get_contents('php://input');
	//$data = json_decode($requested_code);

	//echo 'Data: '.print_r($data);


	// query department
	$stmt = $countrycode->getByCountryCode($requested_code);
	
	if ($stmt !== false) {
	  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  $country_name = $row[0]['country_name'];
	  $result = array(
					"result"=>"success",
					"message"=>"Country name in data field",
					"data"=>$country_name);
	  echo json_encode($result);
	}
	else if ($stmt === false) {
	  $result = array(
					"result"=>"failure",
					"message"=>"Country not found.");
	  echo json_encode($result);
	}
} else {
	$result = array(
					"result"=>"failure",
					"message"=>"no country code provided");
	echo json_encode($result);
}

?>