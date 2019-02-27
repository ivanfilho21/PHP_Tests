<?php $PATH = "../"; ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Sign Up</title>
	
	<?php include $PATH . "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $PATH; ?>styles/auth.css">
</head>
<body>
	<?php
	include $PATH . "database/database.php";
	include $PATH . "database/database_admin.php";
	include $PATH . "scripts/util.php";
	session_start();
	include $PATH . "scripts/verify_user_session.php";

	if ($userIsLogged)
	{
		header("Location: " . $PATH . "index.php");
		die();
	}
	?>

	<div class="header-container">
		<?php include $PATH . "header.php"; ?>
	</div><!-- end header container -->

	<main>
		<?php include $PATH . "scripts/auth/registration.php"; ?>
		<div class="page-content">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset>
					<legend>Sign Up</legend>
								
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

	<?php include $PATH . "footer.php"; ?>
</body>
</html>