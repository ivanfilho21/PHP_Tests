<?php include "header.html"; include "database/database.php"; include "util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
</head>
<body>
	<?php
	
	$error_msgs = array();
	$fields = array("username", "password");
	$name = $_POST["username"];
	$pass = $_POST["password"];
	
	$res = validation($name, $pass);
	
	function validation($name, $pass)
	{
		global $error_msgs, $fields;
		$res = true;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$res = check_empty_fields($fields);
		}
		
		$res = check_username($name);
		if (!$res)
			$error_msgs["username"] = "Username does not exist.";
		

		return $res;
	}	
	?>

	<div class="content">
	<!-- Title -->
	<h1>Sign In</h1>
	
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
			
			<br>
			<div class="buttonHolder">
				<input type="submit" value="Sign In">
			</div>
		</fieldset>
	</form>
	
	<div class="optionsHolder">
	<p><a href="registration.php">Create an Account</a></p>
	<p><a href="">Forgot your password?</a></p>
	</div>
	
	<?php include "footer.html"; ?>
	</div>
</body>
</html>