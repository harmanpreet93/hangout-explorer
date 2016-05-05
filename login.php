<?php

require 'connect.php';

session_name('Login');

//make the cookie live for 1 week
session_set_cookie_params(7*24*60*60);

//start the session
session_start();

if (isset($_SESSION['err'])){
  echo '<div class="err">'."Note: ".$_SESSION['err'].'</div>';
  echo "<script type='text/javascript'>alert('ERROR!');</script>";
  unset($_SESSION['err']);
}

if (isset($_SESSION["userid"])) {
	// print_r($_SESSION);
	header("Location: browse.php");
	exit;
}

// print_r($_POST);

// print_r($_SESSION);
if (isset($_POST['submit'])) {

	if ($_POST['submit']=='Login') {

		//if the login form has been submitted


		$err = array();
		// Will hold our errors
	  	// echo "<script type='text/javascript'>alert('ghusa BC!');</script>";


		if(!count($err)) {
	  		// echo "<script type='text/javascript'>alert('inside');</script>";

			$_POST['userid'] = mysql_real_escape_string($_POST['userid']);
			$userid = mysql_real_escape_string($_POST['userid']);
	  		// echo "<script type='text/javascript'>alert('the userid is ".$userid."');</script>";

	  		// $row = mysqli_query($conn, $sql);
	  		$result = mysqli_query($conn,"SELECT user_id FROM user WHERE user_id='".$_POST['userid']."'");

		  	if (mysqli_num_rows($result) > 0) {	
		  		while($row = $result->fetch_assoc()) {
		  			$uid = $row['user_id'];
		  			// echo "<script type='text/javascript'>alert('entry found".$uid."');</script>";

					// If everything is OK login

					$_SESSION['usertype'] = 'registered';
					$_SESSION['username']= 'Harman';
					// $_SESSION['cityname']= 'Hyderabad';
					// $_SESSION['username']=$row['username'];
					$_SESSION['userid'] = $row['user_id'];
					echo 'hey user found';
					// Store some data in the session

					header("Location: browse.php");
					exit;
					//redirect to main page after successful login
		  		}
		  	}
	  		else {
	  			$err[] = 'Incorrect user ID. Please try again.';
	  		}
			// $row = mysql_fetch_assoc(mysqli_query($conn,"SELECT user_id FROM user WHERE user_id='".$_POST['userid']."'"));
	  		// echo "<script type='text/javascript'>alert(".$row['user_id'].");</script>";

			// if($row['user_id']) {
	  // 			echo "<script type='text/javascript'>alert('entry found');</script>";

			// 	// If everything is OK login

			// 	$_SESSION['usertype'] = 'registered';
			// 	$_SESSION['username']= 'Chatu';
			// 	// $_SESSION['username']=$row['username'];
			// 	$_SESSION['userid'] = $row['user_id'];
			// 	// echo 'hey user found';
			// 	// Store some data in the session

			// 	header("Location: browse.php");
			// 	exit;
			// 	//redirect to main page after successful login
			// }
			// else {
	  // 			// echo "<script type='text/javascript'>alert('not found!');</script>";

			// 	// echo 'hey user not found';
			// 	$err[] = 'Incorrect user ID. Please try again.';
			// }
		}

		else if($err) {
	  		echo "<script type='text/javascript'>alert('error!!!');</script>";

			$_SESSION['err'] = implode('<br />',$err);
			header("Location: index.php");
			exit;
		}

	}

}

if (isset($_POST['guestSubmit'])) {

	if ($_POST['guestSubmit']=='Guest') {
		//if the guest form has been submitted
		$_SESSION['usertype'] = 'guest';
		// print_r($_SESSION);
	  	// echo "<script type='text/javascript'>alert('found!');</script>";

		header("Location: browse.php");
		exit;
	}
}


?>