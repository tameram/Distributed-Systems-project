<?php
 
class CountryCode {
 
    // database connection and table name
    private $conn;
    private $table_name = "countrycodes";
    // object properties
    public $code;
    public $name;
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }
	
	// read departments
    function getByCountryCode($country_code) {
		
		$stmt = $this->conn->prepare(
		  "SELECT * FROM ".$this->table_name." WHERE country_code = :countryCode");
		$stmt->bindParam(':countryCode', $country_code, PDO::PARAM_STR, 23);
		// "ss' is a format string, each "s" means string
		$stmt->execute();

		//$stmt->bind_result($col1, $col2);

        // execute query
        //$stmt->execute();
		if ($stmt->rowCount() < 1) { return false; }
        return $stmt;
    }
}