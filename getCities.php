<?php

require 'connect.php';

$string = $_POST['keyword'];

$cityList = mysqli_query($conn, "SELECT `name` FROM swe_cities WHERE `name` LIKE '{$string}%' ");

$names = array();

if (mysqli_num_rows($cityList) > 0) {	
	while($row = $cityList->fetch_assoc()) {
    	array_push($names, $row['name']);
	}
}

$jsonString = json_encode($names);
echo $jsonString;
// $row = mysqli_fetch_array($cityList, MYSQL_BOTH);
// echo(json_encode($row['name'],true));

?>