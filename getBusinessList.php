<?php

require 'connect.php';

$cityname = $_POST['cityname'];
$_SESSION['cityname'] = $cityname;

$businessList = mysqli_query($conn, "SELECT `*` FROM business WHERE `city` = '$cityname' ");
$row = mysqli_fetch_array($businessList, MYSQL_BOTH);
echo(json_encode($row,true));

?>