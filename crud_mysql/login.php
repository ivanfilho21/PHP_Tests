<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Sign In</title>
	
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
		<?php include "scripts/login/login.php"; ?>
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

	<?php include "footer.php"; ?>
</body>
</html>