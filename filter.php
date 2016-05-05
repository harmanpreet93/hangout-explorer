<?php
session_name('Login');
session_start();

require 'connect.php';

if (isset($_POST)) {
	$query = "SELECT * FROM ( SELECT * FROM business WHERE city = '".$_SESSION['cityname']."'";
  	// echo "<script type='text/javascript'>alert('".$query."');</script>";

	$categoryStr = "";
	if (isset($_POST['categoryArr'])) {
		$categoryArr = $_POST['categoryArr'];

  		// echo "<script type='text/javascript'>alert('".$categoryArr[0]."');</script>";

		//creating comma separated values
		for ($i=0;$i<sizeof($categoryArr);$i++) {
			$categoryStr = $categoryStr.$categoryArr[$i].",";
		}

		// echo "categoryStr is ".$categoryStr."</br>";
		$categoryStr = substr($categoryStr, 0,strlen($categoryStr)-1);

		$query .= " AND FIND_IN_SET(categories, '".$categoryStr."')";

	}
	
	if (isset($_POST['rating'])) {
		$rating = $_POST['rating'];
		$query .= " AND stars >=".$rating;
	}

	$query .= ") b";


	if (isset($_POST['visited'])) { 
		if ($_SESSION['usertype'] == 'registered') {
			$userid = $_SESSION['userid'];
			$query .= " INNER JOIN review r ON b.business_id = r.business_id AND user_id = '".$userid."'";
		}
	}
  	// echo "<script type='text/javascript'>alert('".$query."');</script>";


	$businessList = mysqli_query($conn, $query);
  	// echo "<script type='text/javascript'>alert('".$businessList[0]."');</script>";


	
	$data = array();
	
	if ($businessList != false && mysqli_num_rows($businessList) > 0) {	
	while($row = mysqli_fetch_assoc($businessList)) {
    	array_push($data, $row);
	}
}
  	// echo "<script type='text/javascript'>alert('qq ".(string)$data."');</script>";

$jsonString = json_encode($data);

echo $jsonString;

	// $row = mysqli_fetch_array($conn, MYSQL_BOTH);

  	// echo "<script type='text/javascript'>alert('row ".$row."');</script>";

	// echo(json_encode($row,true));
}

?>