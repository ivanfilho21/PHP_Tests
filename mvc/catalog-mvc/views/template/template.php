<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>normalize.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>general.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>header.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>footer.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ."assets/css/"; ?>home.css">

	<?php if (file_exists("assets/css/" .$viewName .".css")) : ?>
		<!-- <link rel="stylesheet" href="<?php #echo BASE_URL ."assets/css/" .$viewName; ?>.css"> -->
	<?php endif; ?>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
	<!-- Mobile specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="darkslategray">
</head>
<body class="light">
	<!-- Header -->
	<header class="header dark">
		<div class="logo">
			<a href="<?php echo BASE_URL; ?>">Catalog</a>
		</div>

		<?php
		if (! empty($_POST["search-text"])) {
			$util = new Util();
			$query = $util->formatHTMLInput($_POST["search-text"]);
			
			?>
			<div id="link" data-link="<?php echo BASE_URL ."search?q=" .$query; ?>"></div>
			<script>
				var e = document.getElementById("link");
				window.location.href = e.getAttribute("data-link");
			</script>
			<?php
			exit();
		}
		?>

		<form class="search-bar" method="POST">
			<input type="text" name="search-text" placeholder="Search" value="<?php echo (! empty($_GET["q"])) ? $_GET['q'] : ''; ?>">
			<button type="submit" class="btn btn-search"><i class="fas fa-search"></i></button>
			<a href="#" class="btn-advanced-search btn btn-default"><i class="fas fa-sort-amount-down"></i></a>
		</form>

		<nav class="nav-bar">
			<ul class="menu-list">
				<?php if (! empty(getUserSession())) : ?>
					<li><a href="<?php echo BASE_URL; ?>announcements">My Announcements</a></li>
					<li><a href="<?php echo BASE_URL; ?>authentication/logout">Logout</a></li>
				<?php else : ?>
					<li><a href="<?php echo BASE_URL; ?>authentication/register">Register</a></li>
					<li><a href="<?php echo BASE_URL; ?>authentication/login">Login</a></li>
				<?php endif; ?>
			</ul>
		</nav>

		<!-- Gap necessary in grid 720px -->
		<div></div>
	</header>
	
	<!-- Main -->
	<?php $this->loadViewInTemplate($viewName); ?>

	<!-- Footer -->
	<footer class="footer light">
		<p class="copyright">
			© 2019 - <a href="https://github.com/ivanfilho21">Ivan Filho</a>
		</p>
		<p class="license">
			Licensed under the MIT License.
		</p>
	</footer>
</body>
</html>