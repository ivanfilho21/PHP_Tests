<?php include "header.html"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="main_style.css">
</head>
<body>
	<?php
	$error_msgs = array("");
	$fields = array("username", "password", "password_confirm");
	$user_info = array();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		foreach ($fields as $fd)
		{
			$data = $_POST[$fd];
			
			if (empty($data))
			{
				$error_msgs[$fd] = "This field should not be empty.";
			}
			else
			{
				$user_array[$fd] = format_input($data);
			}
		}
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