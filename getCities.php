<?php

require 'connect.php';

$string = $_POST['keyword'];

$cityList = mysqli_query($conn, "SELECT `name` FROM cities WHERE `name` LIKE '%{$string}%' ");
$row = mysqli_fetch_array($cityList, MYSQL_BOTH);
echo(json_encode($row['name'],true));

?>