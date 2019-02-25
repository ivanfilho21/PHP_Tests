<?php $PATH = ""; ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Home Page</title>
	
	<?php include "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="styles/index.css">
</head>
<body>
	<?php
	include "database/database.php";
	include "scripts/util.php";
	session_start();
	include "scripts/verify_user_session.php";
	?>

	<div class="header-container">
		<?php include "header.php"; ?>
	</div><!-- end header container -->

	<main>
		<?php if ($userIsLogged) : ?>
			<?php include "sidebar.php"; ?>
		<div class="page-content">
		<?php else : ?>
		<div class="page-content" style="width: 100%;">
		<?php endif; ?>

			<?php if ($userIsLogged) : ?>
				<?php include "scripts/index/user_logged.php"; ?>
			<?php else : ?>
				<h1>Create and Manage tables in your Database.</h1>

				<p>
					With this Web Application you may <strong>Create</strong>, <strong>Read</strong>, <strong>Update</strong>, and <strong>Delete</strong> entities from the <strong>MySQL Database</strong>.
				</p>

				<br>
				<h3>You must have an account and be logged in to use this website.</h3>
				<input class="button" type="submit" value="Sign In" onClick="parent.location='auth/login.php'">
				or
				<input class="button" type="submit" value="Create Your Account" onClick="parent.location='auth/registration.php'">
			<?php endif; ?>
		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>