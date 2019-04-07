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
	<link rel="stylesheet" href="assets/css/index.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Mobile specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="darkslategray" />
</head>
<body class="light">
	<nav class="nav-bar dark">
		<div class="nav-bar-header">
			<a href="index.php">Catalog</a>
		</div>
		<form class="search-bar" method="GET">
			<input type="text" name="search-text" placeholder="Search">
			<!-- <input type="submit" name="search" value="" class=""> -->
			<button type="submit" class="btn btn-search"><i class="fas fa-search"></i></button>
			<a href="#" class="btn-advanced-search btn btn-default"><i class="fas fa-sort-amount-down"></i></a>
		</form>
		<div></div>
		<ul class="nav-bar-menu-list">
			<?php if (! empty(getUserSession())) : ?>
				<li><a href="my-announcements.php">My Announcements</a></li>
				<li><a href="logout.php">Logout</a></li>
			<?php else : ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			<?php endif; ?>
		</ul>
		<div class="clear-fix"></div>
	</nav>