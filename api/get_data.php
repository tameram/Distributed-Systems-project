<?php



$xml = simplexml_load_file('data.xml');//open the file data.xml. put the data ento $xml

//var_dump($xml);
echo $xml->country[5]['name'];


//foreach ($contries->countries as $cont)
//	echo $cont->name."<br>"; 
$con = new mysqli('localhost', 'root', '', 'countrycodes');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 



//mysql_select_db('countrycodes' , $con);

foreach ($xml->country as $country) {
	$country_name = $con->real_escape_string($country['name']);
	$country_code = $con->real_escape_string($country['country-code']);
	//echo $country_name." - ".$country_code."<br>";
	$query = "INSERT INTO countrycodes (country_name, country_code) VALUES ('$country_name', '$country_code')";
	if ($con->query($query) === true) {
		echo "Succesfuly added <b>".$country_name.":".$country_code." to DB<br>";
	}
	else {
		echo "<span style=\"color: red;\">Failed to add <b>".$country_name.":".$country_code." to DB</span>: ".$con->error."<br>";
	}
}


?>