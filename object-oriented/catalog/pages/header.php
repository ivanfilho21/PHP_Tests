<?php require "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Catalog</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<!-- Template specific -->
	<link rel="stylesheet" href="assets/css/general.css">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/footer.css">
	<!-- Mobile specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="darkslategray" />
</head>
<body class="light">
	<nav class="nav-bar dark">
		<div class="nav-bar-header">
			<a href="index.php">Catalog</a>
		</div>
		<ul class="nav-bar-menu-list">
			<?php if (isset($_SESSION["user-session"]) && ! empty($_SESSION["user-session"])) : ?>
				<li><a href="#">My Announcements</a></li>
				<li><a href="#">Logout</a></li>
			<?php else : ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			<?php endif; ?>
		</ul>
	</nav>