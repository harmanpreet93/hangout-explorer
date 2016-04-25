<?php

require 'connect.php';

$query = "SELECT * FROM ( SELECT * FROM business WHERE city = '". $_SESSION['cityname'] . "'";

if (isset($_POST['filter'])) {
	if (isset($_POST['categoryArr'])) {
		$categoryArr = $_POST['categoryArr'];

		//creating comma separated values
		for ($i=0;$i<sizeof($categoryArr);$i++) {
			$categoryStr = $categoryStr.$categoryArr[$i].",";
		}

		// echo "categoryStr is ".$categoryStr."</br>";
		$categoryStr = substr($categoryStr, 0,strlen($categoryStr)-1);

		$query .= "AND FIND_IN_SET(category, ".$categoryStr.") ";
	}
	
	if (isset($_POST['rating'])) {
		$rating = $_POST['rating'];
		$query .= "AND stars >=".$rating;
	}

	$query .= ") b";

	if (isset($_POST['visited'])) { 
		if ($_SESSION['usertype'] == 'registered') {
			$userid = $_SESSION['userid'];
			$query .= "INNER JOIN review r ON b.business_id = t.business_id AND user_id = '".$userid."'";
		}
	}

	$businessList = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($conn, MYSQL_BOTH);
	echo(json_encode($row,true));
}

?>