<?php
    require 'login.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hangout Hunter</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/form-elements.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="ico/favicon.ico">
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Hangout</strong> Hunter</h1>
                            <div class="description">
                            	<p>
	                            	<strong>Get the summarized reviews for the businesses in your area.</strong>
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login</h3>
                        		</div>
                        		<!-- <div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div> -->
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="userid" placeholder="User ID" class="form-username form-control" id="username" required>
			                        </div>
			                        <!-- <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div> -->
			                        <input type="submit" class="btn" name="submit" value="Login" style="width: 100%;"></input>

			                    </form>
			                    <!-- <form role="form" method="post" action="" class="login-form">
			                        <input type="submit" class="btn" name="guestSubmit" value="Guest" style="margin-top: 10px; width: 100%" ></input>
			                    </form> -->

		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>or login as:</h3>
                        	<form role="form" method="post" action="" class="login-form">
                                    <input type="submit" class="btn" name="guestSubmit" value="Guest" style="margin-top: 10px; width: 50%" ></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/scripts_index.js"></script>
        
    </body>

</html>