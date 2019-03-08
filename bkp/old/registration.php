<?php
include "header.html";
include "database/database_admin.php";
include "scripts/util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Sign Up</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
</head>
<body>
	<?php include "scripts/login/registration.php"; ?>

	<div class="container">
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