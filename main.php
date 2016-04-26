<?php
session_name('Login');
session_start();

// require 'filter.php';

	// $hello = 'hello';
	// print_r($hello);
	// print_r($_SESSION);
	// header("Location: browse.php");
	// exit;


// if(!$_SESSION['userid']) {
// 	header("Location: index.php");
// 	exit;
// }

if(isset($_GET['logout'])) {
	$_SESSION = array();
	session_destroy();

	header("Location: index.php");
	exit;
}

echo '<div id="welcome">Welcome ' .$_SESSION['username']. '!</div>';

?> 