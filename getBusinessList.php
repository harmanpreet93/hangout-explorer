<?php

session_name('Login');
session_start();

require 'connect.php';

$cityname = $_POST['cityname'];
$_SESSION['cityname'] = $cityname;


// echo "<script type='text/javascript'>alert('".$_SESSION['cityname']."');</script>";

$sql = "SELECT * FROM swe_business WHERE city = '".$cityname."'";
$businessList = mysqli_query($conn, $sql);	

$data = array();
if ($businessList != false && mysqli_num_rows($businessList) > 0) {	
	while($row = mysqli_fetch_assoc($businessList)) {
    	array_push($data, $row);
	}
}


$jsonString = json_encode($data);
echo $jsonString;

?>