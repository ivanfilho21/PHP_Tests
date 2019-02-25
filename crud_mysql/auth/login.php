<?php $PATH = "../"; ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Sign In</title>
	
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
		<?php include $PATH . "scripts/auth/login.php"; ?>
		<div class="page-content">
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
			</form><!-- end form -->
			
			<div class="options-holder">
				<p><a href="registration.php">Create an Account</a></p>
				
			</div><!-- end options-holder -->
		</div><!-- end page content -->
	</main><!-- end main -->

	<?php include $PATH . "footer.php"; ?>
</body>
</html>