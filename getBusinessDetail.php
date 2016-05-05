<?php
session_name('Login');
session_start();

require 'connect.php';

$businessid = $_POST['businessid'];
$userid = $_SESSION['userid'];

// echo "<script type='text/javascript'>alert('found!');</script>";


// $businessDetail = mysqli_query($conn, "SELECT * FROM business WHERE business_id = '".$businessid."'");
// // $names = array();
// // if (mysqli_num_rows($businessDetail) > 0) {	
// // 	while($row = $businessDetail->fetch_assoc()) {
// //     	array_push($names, $row['name']);
// // 	}
// // }


// $row = mysqli_fetch_array($conn, MYSQL_BOTH);
// $encodedBusinessDetail = json_encode($row,true);

$reviewDetail = mysqli_query($conn, "SELECT * FROM review WHERE business_id = '".$businessid."' AND user_id = '".$userid."' ");
$reviews = array();
if (mysqli_num_rows($reviewDetail) > 0) {	
	while($row = $reviewDetail->fetch_assoc()) {
    	array_push($reviews, $row);
	}
}

$encodedReviewDetail = json_encode($reviews);
// echo $encodedReviewDetail;

$filepath = "wordcloud/".$businessid.'.json';
// $filepath = "-QeQ71am64JKQmiPIThreQ.json";
$wordCloud = file_get_contents($filepath);
// echo json_encode($wordCloud);

echo json_encode(array('reviewDetail' => $encodedReviewDetail, 'wordCloud' => $wordCloud));

?>