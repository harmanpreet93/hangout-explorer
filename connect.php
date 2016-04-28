<?php

/* Database config */
$db_host		= '192.168.112.159';
$db_user		= 'root';
$db_pass		= '1234';
$db_database	= 'yelpdb';

/* Create connection */
$conn = new mysqli($db_host, $db_user, $db_pass, $db_database);

/* Check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>