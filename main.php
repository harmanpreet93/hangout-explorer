<?php

require 'filter.php';

if(!$_SESSION['userid']) {
	header("Location: login.php");
	exit;
}

if(isset($_GET['logout'])) {
	$_SESSION = array();
	session_destroy();

	header("Location: login.php");
	exit;
}

echo '<div id="welcome">Welcome ' .$_SESSION['username']. '!</div>';

?> 