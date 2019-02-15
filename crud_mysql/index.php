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
			<aside class="sidebar">
				<ul>
					<li class="list-section"><a href="">Table Operations</a></li>
					<li id="listTable"><a href="?list_tables"><img width="20" src="icon/menu.svg">List</a></li>
					<li id="createTable"><a href="create.php"><img width="20" src="icon/add.svg">Create</a></li>
					<li id="deleteTable"><a href=""><img width="20" src="icon/garbage.svg">Remove</a></li>
					<li id="updateTable"><a href=""><img width="20" src="icon/edit.svg">Update</a></li>
				</ul>
			</aside>
		<?php endif; ?>

		<div class="page-content">
			<?php
			if ($userIsLogged)
				include "scripts/index/user_logged.php";
			else
				include "user_not_logged.html";
			?>
		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>