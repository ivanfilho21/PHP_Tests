<?php include "header.html"; include "database/database.php"; include "util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
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
		
		$res = validation($name, $pass, $passConf);
		
		if ($res)
		{
			$user_info = array();
			$user_info["username"] = $name;
			$user_info["password"] = $pass;
				
			# Add user in database
			save_user($connection, $user_info);
		}
	}
	
	function validation($name, $pass, $passConf)
	{
		global $error_msgs, $fields;
		$res = true;
		
		$res = check_empty_fields($fields);
		
		# Check username length - max 10
		if (strlen($name) > 10)
		{
			$error_msgs["username"] = "Username is too long.";
			$res = false;
		}
		else
		{
			$res = !check_username($name);
			
			# Check if username exists
			if (!$res)
				$error_msgs["username"] = "This username is already taken.";
		}
		
		# Check password length - max 20
		if (strlen($pass) > 20)
		{
			$error_msgs["password"] = "Password is too long.";
			$res = false;
		}
		
		# Check if passwords match
		if ($res && ($pass != $passConf))
		{
			$error_msgs["password_confirm"] = "Passwords do not match.";
			$res = false;
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
			<span class="error">
			<?php
			if (isset($error_msgs["username"]))
				echo $error_msgs["username"]; ?>
			</span>
			<input type="text" name="username">
			
			<p><label>Password:</label></p>
			<span class="error">
			<?php
			if (isset($error_msgs["password"]))
				echo $error_msgs["password"]; ?>
			</span>
			<input type="password" name="password">
			
			<p><label>Confirm Password:</label></p>
			<span class="error">
			<?php
			if (isset($error_msgs["password_confirm"]))
				echo $error_msgs["password_confirm"]; ?>
			</span>
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