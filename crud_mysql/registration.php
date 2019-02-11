<?php include "header.html"; include "database/database_admin.php"; include "util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Sign Up</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
</head>
<body>
	<?php
	$error_msgs = array("");
	$fields = array("username", "password", "password_confirm");
	$user_info = array();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		# Debugging $_POST;
		/*
		foreach ($_POST as $p)
			echo $p . " ";
		*/
		$name = format_input($_POST["username"]);
		$pass = format_input($_POST["password"]);
		$passConf = format_input($_POST["password_confirm"]);
		
		#$res = validation($name, $pass, $passConf);
		
		if (validateLogin($name, $pass, $passConf))
		{
			$user_info = array();
			$user_info["username"] = $name;
			$user_info["password"] = $pass;
				
			# Add user in database
			save_user($connection, $user_info);
			echo "<h3>User added.</h3>";
		}
	}

	function validateLogin($name, $pass, $passConf)
	{
		global $connection, $error_msgs, $fields;
		$res = true;

		$res = checkEmptyFields($fields);

		# Check username length - max 15
		if (strlen($name) > 15)
		{
			$error_msgs["username"] = "Username is too long.";
			$res = false;
		}
		else
		{
			if (check_username_db($connection, $name))
			{
				# User already exists
				$error_msgs["username"] = "This username is already taken.";
				$res = false;
			}			
		}

		# Check password length - max 20
		if (strlen($pass) > 20)
		{
			$error_msgs["password"] = "Password is too long.";
			$res = false;
		}
		else {
			# Check if password is the same as username or contains the username.
			if ($pass == $name || (strpos($pass, $name) != false))
			{
				$error_msgs["password"] = "Your password may not contain your username.";
				$res = false;
			}
			else
			{
				# Check if passwords match
				if ($pass != $passConf)
				{
					$error_msgs["password_confirm"] = "Passwords do not match.";
					$res = false;
				}
			}
		}
		
		return $res;
	}
	?>

	<div class="content">
	<!-- Title -->
	<h1>Sign Up</h1>
	
	<!-- Form -->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<legend>Sign In</legend>
						
			<p><label>Username:</label></p>
			<span class="error"><?php showError("username"); ?></span>
			<input type="text" name="username">
			
			<p><label>Password:</label></p>
			<span class="error"><?php showError("password"); ?></span>
			<input type="password" name="password">
			
			<p><label>Confirm Password:</label></p>
			<span class="error"><?php showError("password_confirm"); ?></span>
			<input type="password" name="password_confirm">
			
			<br>
			<div class="buttonHolder">
				<input type="submit" value="Create Account">
			</div>
		</fieldset>
	</form>
	
	<div class="optionsHolder">
	<p><a href="login.php">Login to Your Account</a></p>
	</div>
	
	<?php include "footer.html"; ?>
	</div>
</body>
</html>