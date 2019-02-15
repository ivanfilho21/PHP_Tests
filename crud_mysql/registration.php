<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Sign Up</title>
	
	<?php include "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="styles/sign.css">
</head>
<body>
	<?php
	include "database/database.php";
	include "database/database_admin.php";
	include "scripts/util.php";
	include "scripts/verify_user_session.php";
	session_start();
	?>

	<div class="header-container">
		<?php include "header.php"; ?>
	</div><!-- end header container -->

	<main>
		<?php include "scripts/login/registration.php"; ?>
		<div class="page-content">
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
			</form><!-- end form -->
			
			<div class="options-holder">
			<p><a href="login.php">Log In to Your Account</a></p>
			</div><!-- end options-holder -->
		</div><!-- end page content -->
	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>