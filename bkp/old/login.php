<?php
include "header.html";
include "database/database_admin.php";
include "scripts/util.php"; session_start();
?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Sign In</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
</head>
<body>
	<?php include "scripts/login/login.php"; ?>

	<div class="container">
		<!-- Title -->
		<h1>Sign In</h1>
		
		<!-- Form -->
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<fieldset>
				<legend>Sign In</legend>
				
				<p><label>Username:</label></p>
				<input type="text" name="username">
				
				<p><label>Password:</label></p>
				<input type="password" name="password">
				
				<span class="error"><?php showError("login"); ?></span>
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
		
		<!-- Footer -->
		<?php include "footer.html"; ?>
	</div>
</body>
</html>