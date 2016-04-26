<?php

require 'connect.php';

$businessid = $_GET['businessid'];
$userid = $_SESSION['userid'];

$businessDetail = mysqli_query($conn, "SELECT `*` FROM business WHERE `business_id` = '$businessid' ");
$row = mysqli_fetch_array($conn, MYSQL_BOTH);
$encodedBusinessDetail = json_encode($row,true);

$reviewDetail = mysqli_query($conn, "SELECT `*` FROM review WHERE `business_id` = '$businessid' AND `user_id` = '$userid' ");
$row = mysqli_fetch_array($conn, MYSQL_BOTH);
$encodedReviewDetail = json_encode($row,true);

echo json_encode(array('businessDetail' => $encodedBusinessDetail, 'reviewDetail' => $encodedReviewDetail));

?>