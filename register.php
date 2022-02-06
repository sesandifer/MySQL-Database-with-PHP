<?php

    require("config.php");
    
    session_start();
    
?>

<?php
    if(isset($_SESSION["id"])){
        include("header_orig.php");
?>
        <h1>Welcome <?php echo $_SESSION["username"]; ?>!</h1>
        

<?php
    }
    else {
        include("header.php");
    }    
?>




<?php

$error = false;
if (isset($_POST['signup'])) {
	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
	$password = mysqli_real_escape_string($mysqli, $_POST['password']);
	$cpassword = mysqli_real_escape_string($mysqli, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$username)) {
		$error = true;
		$uname_error = "Name can only consist of letters and spaces";
	}

	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($mysqli, "INSERT INTO users(username, password) VALUES('" . $username . "', '" . md5($password) . "')")) {
			$success_message = "Successfully Registered!";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
}
?>



<div class="align-center">
<h2></h2>	
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
				    <legend><h2>Registration</h2></legend>
					<div class="form-group">
						<label for="username"><h5></h5></label>
						<input type="text" name="username" placeholder="Create A User Name" required class="form-control" />
						<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
					</div>					

					<div class="form-group">
						<label for="name"><h5></h5></label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name"><h5></h5></label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>
					
					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary btn-lg" />
						<div class="btn">
						    <input type="reset" class="btn btn-warning" value="Clear">
						</div>    
					</div>
					
				</fieldset>
			</form>
			<div>
    			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
    			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
			</div>
		</div>
	</div>

</div>