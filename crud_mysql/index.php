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
			<!-- Show sidebar -->
		<?php endif; ?>

		<div class="page-content">
			<?php
			if ($userIsLogged)
				include "scripts/index/user_logged.php";
			else
				include "user_not_logged.html";
			?>
		</div>
	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>