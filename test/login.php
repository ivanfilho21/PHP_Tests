<?php include "header.html"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="main_style.css">
</head>
<body>
	<?php
	
	$err_username = $err_password = "";
	$username = $password = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["username"]))
			$err_username = "Username is required.";
		else
		{
			$username = format_input($_POST["username"]);
		}
		
		if (empty($_POST["password"]))
			$err_password = "Password is required.";
		else
		{
			$password = format_input($_POST["password"]);
		}
	}
	
	function format_input($data)
	{
		$data = trim($data); # Removes additional blank spaces.
		$data = stripslashes($data); # Removes slashes (\);
		$data = htmlspecialchars($data); # Removes special characters.
		return $data;
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
			<span class="error"><?php echo $err_username; ?></span>
			<input type="text" name="username">
			
			<p><label>Password:</label></p>
			<span class="error"><?php echo $err_password; ?></span>
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
	
	<footer class=clear>
		<!-- Credits -->
		<div class="iconCredits">
			<br>
			Icons made by
			<a href="https://www.freepik.com/" title="Freepik">Freepik</a>
			from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
			is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
		</div>
	</footer>
	</div>
</body>
</html>