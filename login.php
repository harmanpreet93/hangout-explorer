<?php

require 'connect.php';

session_name('Login');

//make the cookie live for 1 week
session_set_cookie_params(7*24*60*60);

//start the session
session_start();

if($_SESSION['err']) {
  echo '<div class="err">'."Note: ".$_SESSION['err'].'</div>';
  //echo "<script type='text/javascript'>alert('ERROR!');</script>";
  unset($_SESSION['err']);
}

if($_SESSION['userid']) {
	header("Location: main.php");
	exit;
}

if($_POST['submit']=='Login') {
	//if the login form has been submitted

	$err = array();
	// Will hold our errors

	if(!count($err)) {

		$_POST['userid'] = mysql_real_escape_string($_POST['userid']);

		$row = mysql_fetch_assoc(mysql_query("SELECT id, username FROM table WHERE id='{$_POST['userid']}'"));

		if($row['username']) {
			// If everything is OK login

			$_SESSION['usertype'] = 'registered';
			$_SESSION['username']=$row['username'];
			$_SESSION['userid'] = $row['userid'];
			// Store some data in the session

			header("Location: main.php");
			exit;
			//redirect to main page after successful login
		}
		else {
			$err[] = 'Incorrect user ID. Please try again.';
		}
	}

	if($err) {
		$_SESSION['err'] = implode('<br />',$err);
		header("Location: login.php");
		exit;
	}

}

else if($_POST['submit']=='Guest') {
	//if the guest form has been submitted
	$_SESSION['usertype'] = 'guest';
	header("Location: main.php");
	exit;
}

?>