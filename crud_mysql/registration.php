<?php include "header.html"; include "database/database.php"; ?>

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
	
	# SAVING DATA
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		# Debugging $_POST;
		/*
		foreach ($_POST as $p)
			echo $p . " ";
		*/
			
		$res = true;
		$name = format_input($_POST["username"]);
		
		if (empty($name))
		{
			$error_msgs["username"] = "Username cannot be empty.";
			$res = false;
		}
		if (strlen($name) > 10)
		{
			$error_msgs["username"] = "Username is too long.";
			$res = false;
		}
		else
		{
			$res = check_username($connection, $name);
			if (!$res)
				$error_msgs["username"] = "This username is already taken.";
		}
		
		$pass = format_input($_POST["password"]);
		
		if (empty($pass))
		{
			$error_msgs["password"] = "Password cannot be empty.";
			$res = false;
		}
		if (strlen($pass) > 20)
		{
			$error_msgs["password"] = "Password is too long.";
			$res = false;
		}
		
		$passConf = format_input($_POST["password_confirm"]);
		
		if (empty($passConf))
		{
			$error_msgs["password_confirm"] = "Password cannot be empty.";
			$res = false;
		}
		
		if ($res)
		{
			if ($pass == $passConf)
			{
				$user_info = array();
				$user_info["username"] = $name;
				$user_info["password"] = $pass;
				
				# Add user in database
				save_user($connection, $user_info);
			}
			else
			{
				$error_msgs["password_confirm"] = "Passwords do not match.";
				$res = false;
			}
		}
	}
	
	function check_username($connection, $name)
	{
		$users = get_users($connection);
		
		for ($i = 0; $i < count($users); $i++)
		{
			if ($users[$i]["username"] == $name)
				return false;
		}
		
		return true;
	}
	
	function format_input($data)
	{
		$data = trim($data); # Removes additional blank spaces;
		$data = stripslashes($data); # Removes slashes (\);
		$data = htmlspecialchars($data); # Removes special characters.
		return $data;
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