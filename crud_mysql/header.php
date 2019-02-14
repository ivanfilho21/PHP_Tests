<header>
	<div class="app-name">
		<a href="index.php" id="site-name">CRUD MySQL</a>
	</div>
	
	<nav>
		<ul>
			<?php if ($userIsLogged) : ?>
				<li><a href="?sign_out">Sign Out</a></li>
			<?php else : ?>
				<li><a href="login.php">Sign In</a></li>
				<li><a href="registration.php">Sign Up</a></li>
			<?php endif; ?>
		</ul>
	</nav>
</header>
<div class="clear-fix"></div>