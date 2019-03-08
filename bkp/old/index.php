<?php
#include "header.html";
include "database/database.php";
include "scripts/util.php";
session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">

	<title>CRUD MySQL - Home Page</title>
	<meta name="description=" content="Index page of CRUD MySQL">
	<meta name="author" content="Ivan Filho">
	
	<link rel="stylesheet" href="styles/normalize.css">
	<!--<link rel="stylesheet" href="styles/main_style.css">-->
	<link rel="stylesheet" href="styles/index_style.css">
	<link rel="icon" href="icon/db.png">
</head>
<body>
	<!--
		header
		container
		footer
	-->
	<div class="container">

		<header>
			<div id="title">
				<h1><a href="index.php">CRUD MySQL</a></h1>
			</div>
			<nav>
				<ul id="menuList">
					<li><a href="login.php">Sign In</a></li>
					<li><a href="registration.php">Sign Up</a></li>
				</ul>
			</nav>
		</header>
		
		<main>
			<?php include "scripts/index/verify_user_session.php" ?>

			<?php if ($userIsLogged) : ?>
			<div class="contentLeft">
				<nav class="optionsNav">
					<?php include "sidebar.php"; ?>
				</nav>
			</div>
			<?php endif; ?>
			<div class="contentRight" <?php if ($userIsLogged) echo "style='float: right; margin: 0;'"; ?> >
				
				<?php if ($userIsLogged) : ?>
					<?php include "scripts/index/user_logged.php"; ?>
				<?php else : ?>
					<?php include "user_not_logged.html"; ?>
				<?php endif; ?>
			</div> <!-- contentRight -->

			<div class="clearFix"></div>

		</main> <!-- End of content -->

		<?php include "footer.html"; ?>
	</div>
</body>
</html>