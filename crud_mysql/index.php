<?php
include "header.html";
include "database/database.php";
include "util.php";
session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Home Page</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
	<link rel="stylesheet" type="text/css" href="styles/index_style.css">
</head>
<body>
	<div class="container">
		<div class="content">
			<?php include "index_verify_user_session.php" ?>

			<?php if ($userIsLogged) : ?>
			<div class="contentLeft">
				<nav class="optionsNav">
					<ul class="optionsList">
						<li><a href="">Table Operations</a></li>
						<ul>
							<li><a href="">List</a></li>
							<li><a href="">Create</a></li>
							<li><a href="">Remove</a></li>
							<li><a href="">Update</a></li>
						</ul>
						<li><a href="">My Profile</a></li>
						<li><a href="">Sign out</a></li>
					</ul>
				</nav>
			</div>
			<?php endif; ?>
			<div class="contentRight" <?php if ($userIsLogged) echo "style='float: right; margin: 0;'"; ?> >
				<h1>CRUD MySQL</h1>

				<?php if ($userIsLogged) : ?>
				<br>
				<?php include "index_user_logged.php" ?>
				
				<br>
				<?php include "table_example.html"; ?>

				<?php else : ?>
					<?php include "index_user_not_logged.html"; ?>
				<?php endif; ?>
			</div> <!-- contentRight -->

			<div class="clearFix"></div>

			<footer>
				<!-- Credits -->
				<p class="icons">
					Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> licensed under <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
				</p>
				<p class="Copyright">
					Copyright (c) 2019, Ivan Filho
				</p>
			</footer>
		</div> <!-- End of content -->
	</div>
</body>
</html>